(function () {
  const cfg = window.__draftLock;
  if (!cfg) return;

  async function postJson(url) {
    const res = await fetch(url, {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': cfg.csrf,
      }
    });
    return res.json();
  }

  let heartbeatTimer = null;

  async function acquire() {
    const data = await postJson(cfg.lockUrl);

    if (!data.ok) {
      alert(`⛔ این پیش‌نویس در حال ویرایش است.\n\n👤 توسط: ${data.locked_by_name}\n⏳ تا: ${data.lock_expires_at}`);
      window.location.href = cfg.backToList;
      return;
    }

    heartbeatTimer = setInterval(async () => {
      const hb = await postJson(cfg.hbUrl);
      if (!hb.ok) {
        clearInterval(heartbeatTimer);
        alert(`⛔ قفل از دست رفت!\n\n👤 توسط: ${hb.locked_by_name}\n⏳ تا: ${hb.lock_expires_at}`);
        window.location.href = cfg.backToList;
      }
    }, 25000);
  }

  document.addEventListener('DOMContentLoaded', acquire);

  window.addEventListener('beforeunload', () => {
    try {
      navigator.sendBeacon?.(cfg.unlockUrl, new Blob([], { type: 'application/json' }));
    } catch (e) {}
  });
})();
