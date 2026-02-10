function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
/*! jQuery v3.4.1 | (c) JS Foundation and other contributors | jquery.org/license */
!function (e, t) {
  "use strict";

  "object" == (typeof module === "undefined" ? "undefined" : _typeof(module)) && "object" == _typeof(module.exports) ? module.exports = e.document ? t(e, !0) : function (e) {
    if (!e.document) throw new Error("jQuery requires a window with a document");
    return t(e);
  } : t(e);
}("undefined" != typeof window ? window : this, function (C, e) {
  "use strict";

  var t = [],
    E = C.document,
    r = Object.getPrototypeOf,
    s = t.slice,
    g = t.concat,
    u = t.push,
    i = t.indexOf,
    n = {},
    o = n.toString,
    v = n.hasOwnProperty,
    a = v.toString,
    l = a.call(Object),
    y = {},
    m = function m(e) {
      return "function" == typeof e && "number" != typeof e.nodeType;
    },
    x = function x(e) {
      return null != e && e === e.window;
    },
    c = {
      type: !0,
      src: !0,
      nonce: !0,
      noModule: !0
    };
  function b(e, t, n) {
    var r,
      i,
      o = (n = n || E).createElement("script");
    if (o.text = e, t) for (r in c) (i = t[r] || t.getAttribute && t.getAttribute(r)) && o.setAttribute(r, i);
    n.head.appendChild(o).parentNode.removeChild(o);
  }
  function w(e) {
    return null == e ? e + "" : "object" == _typeof(e) || "function" == typeof e ? n[o.call(e)] || "object" : _typeof(e);
  }
  var f = "3.4.1",
    k = function k(e, t) {
      return new k.fn.init(e, t);
    },
    p = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
  function d(e) {
    var t = !!e && "length" in e && e.length,
      n = w(e);
    return !m(e) && !x(e) && ("array" === n || 0 === t || "number" == typeof t && 0 < t && t - 1 in e);
  }
  k.fn = k.prototype = {
    jquery: f,
    constructor: k,
    length: 0,
    toArray: function toArray() {
      return s.call(this);
    },
    get: function get(e) {
      return null == e ? s.call(this) : e < 0 ? this[e + this.length] : this[e];
    },
    pushStack: function pushStack(e) {
      var t = k.merge(this.constructor(), e);
      return t.prevObject = this, t;
    },
    each: function each(e) {
      return k.each(this, e);
    },
    map: function map(n) {
      return this.pushStack(k.map(this, function (e, t) {
        return n.call(e, t, e);
      }));
    },
    slice: function slice() {
      return this.pushStack(s.apply(this, arguments));
    },
    first: function first() {
      return this.eq(0);
    },
    last: function last() {
      return this.eq(-1);
    },
    eq: function eq(e) {
      var t = this.length,
        n = +e + (e < 0 ? t : 0);
      return this.pushStack(0 <= n && n < t ? [this[n]] : []);
    },
    end: function end() {
      return this.prevObject || this.constructor();
    },
    push: u,
    sort: t.sort,
    splice: t.splice
  }, k.extend = k.fn.extend = function () {
    var e,
      t,
      n,
      r,
      i,
      o,
      a = arguments[0] || {},
      s = 1,
      u = arguments.length,
      l = !1;
    for ("boolean" == typeof a && (l = a, a = arguments[s] || {}, s++), "object" == _typeof(a) || m(a) || (a = {}), s === u && (a = this, s--); s < u; s++) if (null != (e = arguments[s])) for (t in e) r = e[t], "__proto__" !== t && a !== r && (l && r && (k.isPlainObject(r) || (i = Array.isArray(r))) ? (n = a[t], o = i && !Array.isArray(n) ? [] : i || k.isPlainObject(n) ? n : {}, i = !1, a[t] = k.extend(l, o, r)) : void 0 !== r && (a[t] = r));
    return a;
  }, k.extend({
    expando: "jQuery" + (f + Math.random()).replace(/\D/g, ""),
    isReady: !0,
    error: function error(e) {
      throw new Error(e);
    },
    noop: function noop() {},
    isPlainObject: function isPlainObject(e) {
      var t, n;
      return !(!e || "[object Object]" !== o.call(e)) && (!(t = r(e)) || "function" == typeof (n = v.call(t, "constructor") && t.constructor) && a.call(n) === l);
    },
    isEmptyObject: function isEmptyObject(e) {
      var t;
      for (t in e) return !1;
      return !0;
    },
    globalEval: function globalEval(e, t) {
      b(e, {
        nonce: t && t.nonce
      });
    },
    each: function each(e, t) {
      var n,
        r = 0;
      if (d(e)) {
        for (n = e.length; r < n; r++) if (!1 === t.call(e[r], r, e[r])) break;
      } else for (r in e) if (!1 === t.call(e[r], r, e[r])) break;
      return e;
    },
    trim: function trim(e) {
      return null == e ? "" : (e + "").replace(p, "");
    },
    makeArray: function makeArray(e, t) {
      var n = t || [];
      return null != e && (d(Object(e)) ? k.merge(n, "string" == typeof e ? [e] : e) : u.call(n, e)), n;
    },
    inArray: function inArray(e, t, n) {
      return null == t ? -1 : i.call(t, e, n);
    },
    merge: function merge(e, t) {
      for (var n = +t.length, r = 0, i = e.length; r < n; r++) e[i++] = t[r];
      return e.length = i, e;
    },
    grep: function grep(e, t, n) {
      for (var r = [], i = 0, o = e.length, a = !n; i < o; i++) !t(e[i], i) !== a && r.push(e[i]);
      return r;
    },
    map: function map(e, t, n) {
      var r,
        i,
        o = 0,
        a = [];
      if (d(e)) for (r = e.length; o < r; o++) null != (i = t(e[o], o, n)) && a.push(i);else for (o in e) null != (i = t(e[o], o, n)) && a.push(i);
      return g.apply([], a);
    },
    guid: 1,
    support: y
  }), "function" == typeof Symbol && (k.fn[Symbol.iterator] = t[Symbol.iterator]), k.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), function (e, t) {
    n["[object " + t + "]"] = t.toLowerCase();
  });
  var h = function (n) {
    var e,
      d,
      b,
      o,
      i,
      h,
      f,
      g,
      w,
      u,
      l,
      T,
      C,
      a,
      E,
      v,
      s,
      c,
      y,
      k = "sizzle" + 1 * new Date(),
      m = n.document,
      S = 0,
      r = 0,
      p = ue(),
      x = ue(),
      N = ue(),
      A = ue(),
      D = function D(e, t) {
        return e === t && (l = !0), 0;
      },
      j = {}.hasOwnProperty,
      t = [],
      q = t.pop,
      L = t.push,
      H = t.push,
      O = t.slice,
      P = function P(e, t) {
        for (var n = 0, r = e.length; n < r; n++) if (e[n] === t) return n;
        return -1;
      },
      R = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
      M = "[\\x20\\t\\r\\n\\f]",
      I = "(?:\\\\.|[\\w-]|[^\0-\\xa0])+",
      W = "\\[" + M + "*(" + I + ")(?:" + M + "*([*^$|!~]?=)" + M + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + I + "))|)" + M + "*\\]",
      $ = ":(" + I + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + W + ")*)|.*)\\)|)",
      F = new RegExp(M + "+", "g"),
      B = new RegExp("^" + M + "+|((?:^|[^\\\\])(?:\\\\.)*)" + M + "+$", "g"),
      _ = new RegExp("^" + M + "*," + M + "*"),
      z = new RegExp("^" + M + "*([>+~]|" + M + ")" + M + "*"),
      U = new RegExp(M + "|>"),
      X = new RegExp($),
      V = new RegExp("^" + I + "$"),
      G = {
        ID: new RegExp("^#(" + I + ")"),
        CLASS: new RegExp("^\\.(" + I + ")"),
        TAG: new RegExp("^(" + I + "|[*])"),
        ATTR: new RegExp("^" + W),
        PSEUDO: new RegExp("^" + $),
        CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + M + "*(even|odd|(([+-]|)(\\d*)n|)" + M + "*(?:([+-]|)" + M + "*(\\d+)|))" + M + "*\\)|)", "i"),
        bool: new RegExp("^(?:" + R + ")$", "i"),
        needsContext: new RegExp("^" + M + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + M + "*((?:-\\d)?\\d*)" + M + "*\\)|)(?=[^-]|$)", "i")
      },
      Y = /HTML$/i,
      Q = /^(?:input|select|textarea|button)$/i,
      J = /^h\d$/i,
      K = /^[^{]+\{\s*\[native \w/,
      Z = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
      ee = /[+~]/,
      te = new RegExp("\\\\([\\da-f]{1,6}" + M + "?|(" + M + ")|.)", "ig"),
      ne = function ne(e, t, n) {
        var r = "0x" + t - 65536;
        return r != r || n ? t : r < 0 ? String.fromCharCode(r + 65536) : String.fromCharCode(r >> 10 | 55296, 1023 & r | 56320);
      },
      re = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g,
      ie = function ie(e, t) {
        return t ? "\0" === e ? "\uFFFD" : e.slice(0, -1) + "\\" + e.charCodeAt(e.length - 1).toString(16) + " " : "\\" + e;
      },
      oe = function oe() {
        T();
      },
      ae = be(function (e) {
        return !0 === e.disabled && "fieldset" === e.nodeName.toLowerCase();
      }, {
        dir: "parentNode",
        next: "legend"
      });
    try {
      H.apply(t = O.call(m.childNodes), m.childNodes), t[m.childNodes.length].nodeType;
    } catch (e) {
      H = {
        apply: t.length ? function (e, t) {
          L.apply(e, O.call(t));
        } : function (e, t) {
          var n = e.length,
            r = 0;
          while (e[n++] = t[r++]);
          e.length = n - 1;
        }
      };
    }
    function se(t, e, n, r) {
      var i,
        o,
        a,
        s,
        u,
        l,
        c,
        f = e && e.ownerDocument,
        p = e ? e.nodeType : 9;
      if (n = n || [], "string" != typeof t || !t || 1 !== p && 9 !== p && 11 !== p) return n;
      if (!r && ((e ? e.ownerDocument || e : m) !== C && T(e), e = e || C, E)) {
        if (11 !== p && (u = Z.exec(t))) if (i = u[1]) {
          if (9 === p) {
            if (!(a = e.getElementById(i))) return n;
            if (a.id === i) return n.push(a), n;
          } else if (f && (a = f.getElementById(i)) && y(e, a) && a.id === i) return n.push(a), n;
        } else {
          if (u[2]) return H.apply(n, e.getElementsByTagName(t)), n;
          if ((i = u[3]) && d.getElementsByClassName && e.getElementsByClassName) return H.apply(n, e.getElementsByClassName(i)), n;
        }
        if (d.qsa && !A[t + " "] && (!v || !v.test(t)) && (1 !== p || "object" !== e.nodeName.toLowerCase())) {
          if (c = t, f = e, 1 === p && U.test(t)) {
            (s = e.getAttribute("id")) ? s = s.replace(re, ie) : e.setAttribute("id", s = k), o = (l = h(t)).length;
            while (o--) l[o] = "#" + s + " " + xe(l[o]);
            c = l.join(","), f = ee.test(t) && ye(e.parentNode) || e;
          }
          try {
            return H.apply(n, f.querySelectorAll(c)), n;
          } catch (e) {
            A(t, !0);
          } finally {
            s === k && e.removeAttribute("id");
          }
        }
      }
      return g(t.replace(B, "$1"), e, n, r);
    }
    function ue() {
      var r = [];
      return function e(t, n) {
        return r.push(t + " ") > b.cacheLength && delete e[r.shift()], e[t + " "] = n;
      };
    }
    function le(e) {
      return e[k] = !0, e;
    }
    function ce(e) {
      var t = C.createElement("fieldset");
      try {
        return !!e(t);
      } catch (e) {
        return !1;
      } finally {
        t.parentNode && t.parentNode.removeChild(t), t = null;
      }
    }
    function fe(e, t) {
      var n = e.split("|"),
        r = n.length;
      while (r--) b.attrHandle[n[r]] = t;
    }
    function pe(e, t) {
      var n = t && e,
        r = n && 1 === e.nodeType && 1 === t.nodeType && e.sourceIndex - t.sourceIndex;
      if (r) return r;
      if (n) while (n = n.nextSibling) if (n === t) return -1;
      return e ? 1 : -1;
    }
    function de(t) {
      return function (e) {
        return "input" === e.nodeName.toLowerCase() && e.type === t;
      };
    }
    function he(n) {
      return function (e) {
        var t = e.nodeName.toLowerCase();
        return ("input" === t || "button" === t) && e.type === n;
      };
    }
    function ge(t) {
      return function (e) {
        return "form" in e ? e.parentNode && !1 === e.disabled ? "label" in e ? "label" in e.parentNode ? e.parentNode.disabled === t : e.disabled === t : e.isDisabled === t || e.isDisabled !== !t && ae(e) === t : e.disabled === t : "label" in e && e.disabled === t;
      };
    }
    function ve(a) {
      return le(function (o) {
        return o = +o, le(function (e, t) {
          var n,
            r = a([], e.length, o),
            i = r.length;
          while (i--) e[n = r[i]] && (e[n] = !(t[n] = e[n]));
        });
      });
    }
    function ye(e) {
      return e && "undefined" != typeof e.getElementsByTagName && e;
    }
    for (e in d = se.support = {}, i = se.isXML = function (e) {
      var t = e.namespaceURI,
        n = (e.ownerDocument || e).documentElement;
      return !Y.test(t || n && n.nodeName || "HTML");
    }, T = se.setDocument = function (e) {
      var t,
        n,
        r = e ? e.ownerDocument || e : m;
      return r !== C && 9 === r.nodeType && r.documentElement && (a = (C = r).documentElement, E = !i(C), m !== C && (n = C.defaultView) && n.top !== n && (n.addEventListener ? n.addEventListener("unload", oe, !1) : n.attachEvent && n.attachEvent("onunload", oe)), d.attributes = ce(function (e) {
        return e.className = "i", !e.getAttribute("className");
      }), d.getElementsByTagName = ce(function (e) {
        return e.appendChild(C.createComment("")), !e.getElementsByTagName("*").length;
      }), d.getElementsByClassName = K.test(C.getElementsByClassName), d.getById = ce(function (e) {
        return a.appendChild(e).id = k, !C.getElementsByName || !C.getElementsByName(k).length;
      }), d.getById ? (b.filter.ID = function (e) {
        var t = e.replace(te, ne);
        return function (e) {
          return e.getAttribute("id") === t;
        };
      }, b.find.ID = function (e, t) {
        if ("undefined" != typeof t.getElementById && E) {
          var n = t.getElementById(e);
          return n ? [n] : [];
        }
      }) : (b.filter.ID = function (e) {
        var n = e.replace(te, ne);
        return function (e) {
          var t = "undefined" != typeof e.getAttributeNode && e.getAttributeNode("id");
          return t && t.value === n;
        };
      }, b.find.ID = function (e, t) {
        if ("undefined" != typeof t.getElementById && E) {
          var n,
            r,
            i,
            o = t.getElementById(e);
          if (o) {
            if ((n = o.getAttributeNode("id")) && n.value === e) return [o];
            i = t.getElementsByName(e), r = 0;
            while (o = i[r++]) if ((n = o.getAttributeNode("id")) && n.value === e) return [o];
          }
          return [];
        }
      }), b.find.TAG = d.getElementsByTagName ? function (e, t) {
        return "undefined" != typeof t.getElementsByTagName ? t.getElementsByTagName(e) : d.qsa ? t.querySelectorAll(e) : void 0;
      } : function (e, t) {
        var n,
          r = [],
          i = 0,
          o = t.getElementsByTagName(e);
        if ("*" === e) {
          while (n = o[i++]) 1 === n.nodeType && r.push(n);
          return r;
        }
        return o;
      }, b.find.CLASS = d.getElementsByClassName && function (e, t) {
        if ("undefined" != typeof t.getElementsByClassName && E) return t.getElementsByClassName(e);
      }, s = [], v = [], (d.qsa = K.test(C.querySelectorAll)) && (ce(function (e) {
        a.appendChild(e).innerHTML = "<a id='" + k + "'></a><select id='" + k + "-\r\\' msallowcapture=''><option selected=''></option></select>", e.querySelectorAll("[msallowcapture^='']").length && v.push("[*^$]=" + M + "*(?:''|\"\")"), e.querySelectorAll("[selected]").length || v.push("\\[" + M + "*(?:value|" + R + ")"), e.querySelectorAll("[id~=" + k + "-]").length || v.push("~="), e.querySelectorAll(":checked").length || v.push(":checked"), e.querySelectorAll("a#" + k + "+*").length || v.push(".#.+[+~]");
      }), ce(function (e) {
        e.innerHTML = "<a href='' disabled='disabled'></a><select disabled='disabled'><option/></select>";
        var t = C.createElement("input");
        t.setAttribute("type", "hidden"), e.appendChild(t).setAttribute("name", "D"), e.querySelectorAll("[name=d]").length && v.push("name" + M + "*[*^$|!~]?="), 2 !== e.querySelectorAll(":enabled").length && v.push(":enabled", ":disabled"), a.appendChild(e).disabled = !0, 2 !== e.querySelectorAll(":disabled").length && v.push(":enabled", ":disabled"), e.querySelectorAll("*,:x"), v.push(",.*:");
      })), (d.matchesSelector = K.test(c = a.matches || a.webkitMatchesSelector || a.mozMatchesSelector || a.oMatchesSelector || a.msMatchesSelector)) && ce(function (e) {
        d.disconnectedMatch = c.call(e, "*"), c.call(e, "[s!='']:x"), s.push("!=", $);
      }), v = v.length && new RegExp(v.join("|")), s = s.length && new RegExp(s.join("|")), t = K.test(a.compareDocumentPosition), y = t || K.test(a.contains) ? function (e, t) {
        var n = 9 === e.nodeType ? e.documentElement : e,
          r = t && t.parentNode;
        return e === r || !(!r || 1 !== r.nodeType || !(n.contains ? n.contains(r) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(r)));
      } : function (e, t) {
        if (t) while (t = t.parentNode) if (t === e) return !0;
        return !1;
      }, D = t ? function (e, t) {
        if (e === t) return l = !0, 0;
        var n = !e.compareDocumentPosition - !t.compareDocumentPosition;
        return n || (1 & (n = (e.ownerDocument || e) === (t.ownerDocument || t) ? e.compareDocumentPosition(t) : 1) || !d.sortDetached && t.compareDocumentPosition(e) === n ? e === C || e.ownerDocument === m && y(m, e) ? -1 : t === C || t.ownerDocument === m && y(m, t) ? 1 : u ? P(u, e) - P(u, t) : 0 : 4 & n ? -1 : 1);
      } : function (e, t) {
        if (e === t) return l = !0, 0;
        var n,
          r = 0,
          i = e.parentNode,
          o = t.parentNode,
          a = [e],
          s = [t];
        if (!i || !o) return e === C ? -1 : t === C ? 1 : i ? -1 : o ? 1 : u ? P(u, e) - P(u, t) : 0;
        if (i === o) return pe(e, t);
        n = e;
        while (n = n.parentNode) a.unshift(n);
        n = t;
        while (n = n.parentNode) s.unshift(n);
        while (a[r] === s[r]) r++;
        return r ? pe(a[r], s[r]) : a[r] === m ? -1 : s[r] === m ? 1 : 0;
      }), C;
    }, se.matches = function (e, t) {
      return se(e, null, null, t);
    }, se.matchesSelector = function (e, t) {
      if ((e.ownerDocument || e) !== C && T(e), d.matchesSelector && E && !A[t + " "] && (!s || !s.test(t)) && (!v || !v.test(t))) try {
        var n = c.call(e, t);
        if (n || d.disconnectedMatch || e.document && 11 !== e.document.nodeType) return n;
      } catch (e) {
        A(t, !0);
      }
      return 0 < se(t, C, null, [e]).length;
    }, se.contains = function (e, t) {
      return (e.ownerDocument || e) !== C && T(e), y(e, t);
    }, se.attr = function (e, t) {
      (e.ownerDocument || e) !== C && T(e);
      var n = b.attrHandle[t.toLowerCase()],
        r = n && j.call(b.attrHandle, t.toLowerCase()) ? n(e, t, !E) : void 0;
      return void 0 !== r ? r : d.attributes || !E ? e.getAttribute(t) : (r = e.getAttributeNode(t)) && r.specified ? r.value : null;
    }, se.escape = function (e) {
      return (e + "").replace(re, ie);
    }, se.error = function (e) {
      throw new Error("Syntax error, unrecognized expression: " + e);
    }, se.uniqueSort = function (e) {
      var t,
        n = [],
        r = 0,
        i = 0;
      if (l = !d.detectDuplicates, u = !d.sortStable && e.slice(0), e.sort(D), l) {
        while (t = e[i++]) t === e[i] && (r = n.push(i));
        while (r--) e.splice(n[r], 1);
      }
      return u = null, e;
    }, o = se.getText = function (e) {
      var t,
        n = "",
        r = 0,
        i = e.nodeType;
      if (i) {
        if (1 === i || 9 === i || 11 === i) {
          if ("string" == typeof e.textContent) return e.textContent;
          for (e = e.firstChild; e; e = e.nextSibling) n += o(e);
        } else if (3 === i || 4 === i) return e.nodeValue;
      } else while (t = e[r++]) n += o(t);
      return n;
    }, (b = se.selectors = {
      cacheLength: 50,
      createPseudo: le,
      match: G,
      attrHandle: {},
      find: {},
      relative: {
        ">": {
          dir: "parentNode",
          first: !0
        },
        " ": {
          dir: "parentNode"
        },
        "+": {
          dir: "previousSibling",
          first: !0
        },
        "~": {
          dir: "previousSibling"
        }
      },
      preFilter: {
        ATTR: function ATTR(e) {
          return e[1] = e[1].replace(te, ne), e[3] = (e[3] || e[4] || e[5] || "").replace(te, ne), "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4);
        },
        CHILD: function CHILD(e) {
          return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || se.error(e[0]), e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && se.error(e[0]), e;
        },
        PSEUDO: function PSEUDO(e) {
          var t,
            n = !e[6] && e[2];
          return G.CHILD.test(e[0]) ? null : (e[3] ? e[2] = e[4] || e[5] || "" : n && X.test(n) && (t = h(n, !0)) && (t = n.indexOf(")", n.length - t) - n.length) && (e[0] = e[0].slice(0, t), e[2] = n.slice(0, t)), e.slice(0, 3));
        }
      },
      filter: {
        TAG: function TAG(e) {
          var t = e.replace(te, ne).toLowerCase();
          return "*" === e ? function () {
            return !0;
          } : function (e) {
            return e.nodeName && e.nodeName.toLowerCase() === t;
          };
        },
        CLASS: function CLASS(e) {
          var t = p[e + " "];
          return t || (t = new RegExp("(^|" + M + ")" + e + "(" + M + "|$)")) && p(e, function (e) {
            return t.test("string" == typeof e.className && e.className || "undefined" != typeof e.getAttribute && e.getAttribute("class") || "");
          });
        },
        ATTR: function ATTR(n, r, i) {
          return function (e) {
            var t = se.attr(e, n);
            return null == t ? "!=" === r : !r || (t += "", "=" === r ? t === i : "!=" === r ? t !== i : "^=" === r ? i && 0 === t.indexOf(i) : "*=" === r ? i && -1 < t.indexOf(i) : "$=" === r ? i && t.slice(-i.length) === i : "~=" === r ? -1 < (" " + t.replace(F, " ") + " ").indexOf(i) : "|=" === r && (t === i || t.slice(0, i.length + 1) === i + "-"));
          };
        },
        CHILD: function CHILD(h, e, t, g, v) {
          var y = "nth" !== h.slice(0, 3),
            m = "last" !== h.slice(-4),
            x = "of-type" === e;
          return 1 === g && 0 === v ? function (e) {
            return !!e.parentNode;
          } : function (e, t, n) {
            var r,
              i,
              o,
              a,
              s,
              u,
              l = y !== m ? "nextSibling" : "previousSibling",
              c = e.parentNode,
              f = x && e.nodeName.toLowerCase(),
              p = !n && !x,
              d = !1;
            if (c) {
              if (y) {
                while (l) {
                  a = e;
                  while (a = a[l]) if (x ? a.nodeName.toLowerCase() === f : 1 === a.nodeType) return !1;
                  u = l = "only" === h && !u && "nextSibling";
                }
                return !0;
              }
              if (u = [m ? c.firstChild : c.lastChild], m && p) {
                d = (s = (r = (i = (o = (a = c)[k] || (a[k] = {}))[a.uniqueID] || (o[a.uniqueID] = {}))[h] || [])[0] === S && r[1]) && r[2], a = s && c.childNodes[s];
                while (a = ++s && a && a[l] || (d = s = 0) || u.pop()) if (1 === a.nodeType && ++d && a === e) {
                  i[h] = [S, s, d];
                  break;
                }
              } else if (p && (d = s = (r = (i = (o = (a = e)[k] || (a[k] = {}))[a.uniqueID] || (o[a.uniqueID] = {}))[h] || [])[0] === S && r[1]), !1 === d) while (a = ++s && a && a[l] || (d = s = 0) || u.pop()) if ((x ? a.nodeName.toLowerCase() === f : 1 === a.nodeType) && ++d && (p && ((i = (o = a[k] || (a[k] = {}))[a.uniqueID] || (o[a.uniqueID] = {}))[h] = [S, d]), a === e)) break;
              return (d -= v) === g || d % g == 0 && 0 <= d / g;
            }
          };
        },
        PSEUDO: function PSEUDO(e, o) {
          var t,
            a = b.pseudos[e] || b.setFilters[e.toLowerCase()] || se.error("unsupported pseudo: " + e);
          return a[k] ? a(o) : 1 < a.length ? (t = [e, e, "", o], b.setFilters.hasOwnProperty(e.toLowerCase()) ? le(function (e, t) {
            var n,
              r = a(e, o),
              i = r.length;
            while (i--) e[n = P(e, r[i])] = !(t[n] = r[i]);
          }) : function (e) {
            return a(e, 0, t);
          }) : a;
        }
      },
      pseudos: {
        not: le(function (e) {
          var r = [],
            i = [],
            s = f(e.replace(B, "$1"));
          return s[k] ? le(function (e, t, n, r) {
            var i,
              o = s(e, null, r, []),
              a = e.length;
            while (a--) (i = o[a]) && (e[a] = !(t[a] = i));
          }) : function (e, t, n) {
            return r[0] = e, s(r, null, n, i), r[0] = null, !i.pop();
          };
        }),
        has: le(function (t) {
          return function (e) {
            return 0 < se(t, e).length;
          };
        }),
        contains: le(function (t) {
          return t = t.replace(te, ne), function (e) {
            return -1 < (e.textContent || o(e)).indexOf(t);
          };
        }),
        lang: le(function (n) {
          return V.test(n || "") || se.error("unsupported lang: " + n), n = n.replace(te, ne).toLowerCase(), function (e) {
            var t;
            do {
              if (t = E ? e.lang : e.getAttribute("xml:lang") || e.getAttribute("lang")) return (t = t.toLowerCase()) === n || 0 === t.indexOf(n + "-");
            } while ((e = e.parentNode) && 1 === e.nodeType);
            return !1;
          };
        }),
        target: function target(e) {
          var t = n.location && n.location.hash;
          return t && t.slice(1) === e.id;
        },
        root: function root(e) {
          return e === a;
        },
        focus: function focus(e) {
          return e === C.activeElement && (!C.hasFocus || C.hasFocus()) && !!(e.type || e.href || ~e.tabIndex);
        },
        enabled: ge(!1),
        disabled: ge(!0),
        checked: function checked(e) {
          var t = e.nodeName.toLowerCase();
          return "input" === t && !!e.checked || "option" === t && !!e.selected;
        },
        selected: function selected(e) {
          return e.parentNode && e.parentNode.selectedIndex, !0 === e.selected;
        },
        empty: function empty(e) {
          for (e = e.firstChild; e; e = e.nextSibling) if (e.nodeType < 6) return !1;
          return !0;
        },
        parent: function parent(e) {
          return !b.pseudos.empty(e);
        },
        header: function header(e) {
          return J.test(e.nodeName);
        },
        input: function input(e) {
          return Q.test(e.nodeName);
        },
        button: function button(e) {
          var t = e.nodeName.toLowerCase();
          return "input" === t && "button" === e.type || "button" === t;
        },
        text: function text(e) {
          var t;
          return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || "text" === t.toLowerCase());
        },
        first: ve(function () {
          return [0];
        }),
        last: ve(function (e, t) {
          return [t - 1];
        }),
        eq: ve(function (e, t, n) {
          return [n < 0 ? n + t : n];
        }),
        even: ve(function (e, t) {
          for (var n = 0; n < t; n += 2) e.push(n);
          return e;
        }),
        odd: ve(function (e, t) {
          for (var n = 1; n < t; n += 2) e.push(n);
          return e;
        }),
        lt: ve(function (e, t, n) {
          for (var r = n < 0 ? n + t : t < n ? t : n; 0 <= --r;) e.push(r);
          return e;
        }),
        gt: ve(function (e, t, n) {
          for (var r = n < 0 ? n + t : n; ++r < t;) e.push(r);
          return e;
        })
      }
    }).pseudos.nth = b.pseudos.eq, {
      radio: !0,
      checkbox: !0,
      file: !0,
      password: !0,
      image: !0
    }) b.pseudos[e] = de(e);
    for (e in {
      submit: !0,
      reset: !0
    }) b.pseudos[e] = he(e);
    function me() {}
    function xe(e) {
      for (var t = 0, n = e.length, r = ""; t < n; t++) r += e[t].value;
      return r;
    }
    function be(s, e, t) {
      var u = e.dir,
        l = e.next,
        c = l || u,
        f = t && "parentNode" === c,
        p = r++;
      return e.first ? function (e, t, n) {
        while (e = e[u]) if (1 === e.nodeType || f) return s(e, t, n);
        return !1;
      } : function (e, t, n) {
        var r,
          i,
          o,
          a = [S, p];
        if (n) {
          while (e = e[u]) if ((1 === e.nodeType || f) && s(e, t, n)) return !0;
        } else while (e = e[u]) if (1 === e.nodeType || f) if (i = (o = e[k] || (e[k] = {}))[e.uniqueID] || (o[e.uniqueID] = {}), l && l === e.nodeName.toLowerCase()) e = e[u] || e;else {
          if ((r = i[c]) && r[0] === S && r[1] === p) return a[2] = r[2];
          if ((i[c] = a)[2] = s(e, t, n)) return !0;
        }
        return !1;
      };
    }
    function we(i) {
      return 1 < i.length ? function (e, t, n) {
        var r = i.length;
        while (r--) if (!i[r](e, t, n)) return !1;
        return !0;
      } : i[0];
    }
    function Te(e, t, n, r, i) {
      for (var o, a = [], s = 0, u = e.length, l = null != t; s < u; s++) (o = e[s]) && (n && !n(o, r, i) || (a.push(o), l && t.push(s)));
      return a;
    }
    function Ce(d, h, g, v, y, e) {
      return v && !v[k] && (v = Ce(v)), y && !y[k] && (y = Ce(y, e)), le(function (e, t, n, r) {
        var i,
          o,
          a,
          s = [],
          u = [],
          l = t.length,
          c = e || function (e, t, n) {
            for (var r = 0, i = t.length; r < i; r++) se(e, t[r], n);
            return n;
          }(h || "*", n.nodeType ? [n] : n, []),
          f = !d || !e && h ? c : Te(c, s, d, n, r),
          p = g ? y || (e ? d : l || v) ? [] : t : f;
        if (g && g(f, p, n, r), v) {
          i = Te(p, u), v(i, [], n, r), o = i.length;
          while (o--) (a = i[o]) && (p[u[o]] = !(f[u[o]] = a));
        }
        if (e) {
          if (y || d) {
            if (y) {
              i = [], o = p.length;
              while (o--) (a = p[o]) && i.push(f[o] = a);
              y(null, p = [], i, r);
            }
            o = p.length;
            while (o--) (a = p[o]) && -1 < (i = y ? P(e, a) : s[o]) && (e[i] = !(t[i] = a));
          }
        } else p = Te(p === t ? p.splice(l, p.length) : p), y ? y(null, t, p, r) : H.apply(t, p);
      });
    }
    function Ee(e) {
      for (var i, t, n, r = e.length, o = b.relative[e[0].type], a = o || b.relative[" "], s = o ? 1 : 0, u = be(function (e) {
          return e === i;
        }, a, !0), l = be(function (e) {
          return -1 < P(i, e);
        }, a, !0), c = [function (e, t, n) {
          var r = !o && (n || t !== w) || ((i = t).nodeType ? u(e, t, n) : l(e, t, n));
          return i = null, r;
        }]; s < r; s++) if (t = b.relative[e[s].type]) c = [be(we(c), t)];else {
        if ((t = b.filter[e[s].type].apply(null, e[s].matches))[k]) {
          for (n = ++s; n < r; n++) if (b.relative[e[n].type]) break;
          return Ce(1 < s && we(c), 1 < s && xe(e.slice(0, s - 1).concat({
            value: " " === e[s - 2].type ? "*" : ""
          })).replace(B, "$1"), t, s < n && Ee(e.slice(s, n)), n < r && Ee(e = e.slice(n)), n < r && xe(e));
        }
        c.push(t);
      }
      return we(c);
    }
    return me.prototype = b.filters = b.pseudos, b.setFilters = new me(), h = se.tokenize = function (e, t) {
      var n,
        r,
        i,
        o,
        a,
        s,
        u,
        l = x[e + " "];
      if (l) return t ? 0 : l.slice(0);
      a = e, s = [], u = b.preFilter;
      while (a) {
        for (o in n && !(r = _.exec(a)) || (r && (a = a.slice(r[0].length) || a), s.push(i = [])), n = !1, (r = z.exec(a)) && (n = r.shift(), i.push({
          value: n,
          type: r[0].replace(B, " ")
        }), a = a.slice(n.length)), b.filter) !(r = G[o].exec(a)) || u[o] && !(r = u[o](r)) || (n = r.shift(), i.push({
          value: n,
          type: o,
          matches: r
        }), a = a.slice(n.length));
        if (!n) break;
      }
      return t ? a.length : a ? se.error(e) : x(e, s).slice(0);
    }, f = se.compile = function (e, t) {
      var n,
        v,
        y,
        m,
        x,
        r,
        i = [],
        o = [],
        a = N[e + " "];
      if (!a) {
        t || (t = h(e)), n = t.length;
        while (n--) (a = Ee(t[n]))[k] ? i.push(a) : o.push(a);
        (a = N(e, (v = o, m = 0 < (y = i).length, x = 0 < v.length, r = function r(e, t, n, _r, i) {
          var o,
            a,
            s,
            u = 0,
            l = "0",
            c = e && [],
            f = [],
            p = w,
            d = e || x && b.find.TAG("*", i),
            h = S += null == p ? 1 : Math.random() || .1,
            g = d.length;
          for (i && (w = t === C || t || i); l !== g && null != (o = d[l]); l++) {
            if (x && o) {
              a = 0, t || o.ownerDocument === C || (T(o), n = !E);
              while (s = v[a++]) if (s(o, t || C, n)) {
                _r.push(o);
                break;
              }
              i && (S = h);
            }
            m && ((o = !s && o) && u--, e && c.push(o));
          }
          if (u += l, m && l !== u) {
            a = 0;
            while (s = y[a++]) s(c, f, t, n);
            if (e) {
              if (0 < u) while (l--) c[l] || f[l] || (f[l] = q.call(_r));
              f = Te(f);
            }
            H.apply(_r, f), i && !e && 0 < f.length && 1 < u + y.length && se.uniqueSort(_r);
          }
          return i && (S = h, w = p), c;
        }, m ? le(r) : r))).selector = e;
      }
      return a;
    }, g = se.select = function (e, t, n, r) {
      var i,
        o,
        a,
        s,
        u,
        l = "function" == typeof e && e,
        c = !r && h(e = l.selector || e);
      if (n = n || [], 1 === c.length) {
        if (2 < (o = c[0] = c[0].slice(0)).length && "ID" === (a = o[0]).type && 9 === t.nodeType && E && b.relative[o[1].type]) {
          if (!(t = (b.find.ID(a.matches[0].replace(te, ne), t) || [])[0])) return n;
          l && (t = t.parentNode), e = e.slice(o.shift().value.length);
        }
        i = G.needsContext.test(e) ? 0 : o.length;
        while (i--) {
          if (a = o[i], b.relative[s = a.type]) break;
          if ((u = b.find[s]) && (r = u(a.matches[0].replace(te, ne), ee.test(o[0].type) && ye(t.parentNode) || t))) {
            if (o.splice(i, 1), !(e = r.length && xe(o))) return H.apply(n, r), n;
            break;
          }
        }
      }
      return (l || f(e, c))(r, t, !E, n, !t || ee.test(e) && ye(t.parentNode) || t), n;
    }, d.sortStable = k.split("").sort(D).join("") === k, d.detectDuplicates = !!l, T(), d.sortDetached = ce(function (e) {
      return 1 & e.compareDocumentPosition(C.createElement("fieldset"));
    }), ce(function (e) {
      return e.innerHTML = "<a href='#'></a>", "#" === e.firstChild.getAttribute("href");
    }) || fe("type|href|height|width", function (e, t, n) {
      if (!n) return e.getAttribute(t, "type" === t.toLowerCase() ? 1 : 2);
    }), d.attributes && ce(function (e) {
      return e.innerHTML = "<input/>", e.firstChild.setAttribute("value", ""), "" === e.firstChild.getAttribute("value");
    }) || fe("value", function (e, t, n) {
      if (!n && "input" === e.nodeName.toLowerCase()) return e.defaultValue;
    }), ce(function (e) {
      return null == e.getAttribute("disabled");
    }) || fe(R, function (e, t, n) {
      var r;
      if (!n) return !0 === e[t] ? t.toLowerCase() : (r = e.getAttributeNode(t)) && r.specified ? r.value : null;
    }), se;
  }(C);
  k.find = h, k.expr = h.selectors, k.expr[":"] = k.expr.pseudos, k.uniqueSort = k.unique = h.uniqueSort, k.text = h.getText, k.isXMLDoc = h.isXML, k.contains = h.contains, k.escapeSelector = h.escape;
  var T = function T(e, t, n) {
      var r = [],
        i = void 0 !== n;
      while ((e = e[t]) && 9 !== e.nodeType) if (1 === e.nodeType) {
        if (i && k(e).is(n)) break;
        r.push(e);
      }
      return r;
    },
    S = function S(e, t) {
      for (var n = []; e; e = e.nextSibling) 1 === e.nodeType && e !== t && n.push(e);
      return n;
    },
    N = k.expr.match.needsContext;
  function A(e, t) {
    return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase();
  }
  var D = /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i;
  function j(e, n, r) {
    return m(n) ? k.grep(e, function (e, t) {
      return !!n.call(e, t, e) !== r;
    }) : n.nodeType ? k.grep(e, function (e) {
      return e === n !== r;
    }) : "string" != typeof n ? k.grep(e, function (e) {
      return -1 < i.call(n, e) !== r;
    }) : k.filter(n, e, r);
  }
  k.filter = function (e, t, n) {
    var r = t[0];
    return n && (e = ":not(" + e + ")"), 1 === t.length && 1 === r.nodeType ? k.find.matchesSelector(r, e) ? [r] : [] : k.find.matches(e, k.grep(t, function (e) {
      return 1 === e.nodeType;
    }));
  }, k.fn.extend({
    find: function find(e) {
      var t,
        n,
        r = this.length,
        i = this;
      if ("string" != typeof e) return this.pushStack(k(e).filter(function () {
        for (t = 0; t < r; t++) if (k.contains(i[t], this)) return !0;
      }));
      for (n = this.pushStack([]), t = 0; t < r; t++) k.find(e, i[t], n);
      return 1 < r ? k.uniqueSort(n) : n;
    },
    filter: function filter(e) {
      return this.pushStack(j(this, e || [], !1));
    },
    not: function not(e) {
      return this.pushStack(j(this, e || [], !0));
    },
    is: function is(e) {
      return !!j(this, "string" == typeof e && N.test(e) ? k(e) : e || [], !1).length;
    }
  });
  var q,
    L = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/;
  (k.fn.init = function (e, t, n) {
    var r, i;
    if (!e) return this;
    if (n = n || q, "string" == typeof e) {
      if (!(r = "<" === e[0] && ">" === e[e.length - 1] && 3 <= e.length ? [null, e, null] : L.exec(e)) || !r[1] && t) return !t || t.jquery ? (t || n).find(e) : this.constructor(t).find(e);
      if (r[1]) {
        if (t = t instanceof k ? t[0] : t, k.merge(this, k.parseHTML(r[1], t && t.nodeType ? t.ownerDocument || t : E, !0)), D.test(r[1]) && k.isPlainObject(t)) for (r in t) m(this[r]) ? this[r](t[r]) : this.attr(r, t[r]);
        return this;
      }
      return (i = E.getElementById(r[2])) && (this[0] = i, this.length = 1), this;
    }
    return e.nodeType ? (this[0] = e, this.length = 1, this) : m(e) ? void 0 !== n.ready ? n.ready(e) : e(k) : k.makeArray(e, this);
  }).prototype = k.fn, q = k(E);
  var H = /^(?:parents|prev(?:Until|All))/,
    O = {
      children: !0,
      contents: !0,
      next: !0,
      prev: !0
    };
  function P(e, t) {
    while ((e = e[t]) && 1 !== e.nodeType);
    return e;
  }
  k.fn.extend({
    has: function has(e) {
      var t = k(e, this),
        n = t.length;
      return this.filter(function () {
        for (var e = 0; e < n; e++) if (k.contains(this, t[e])) return !0;
      });
    },
    closest: function closest(e, t) {
      var n,
        r = 0,
        i = this.length,
        o = [],
        a = "string" != typeof e && k(e);
      if (!N.test(e)) for (; r < i; r++) for (n = this[r]; n && n !== t; n = n.parentNode) if (n.nodeType < 11 && (a ? -1 < a.index(n) : 1 === n.nodeType && k.find.matchesSelector(n, e))) {
        o.push(n);
        break;
      }
      return this.pushStack(1 < o.length ? k.uniqueSort(o) : o);
    },
    index: function index(e) {
      return e ? "string" == typeof e ? i.call(k(e), this[0]) : i.call(this, e.jquery ? e[0] : e) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1;
    },
    add: function add(e, t) {
      return this.pushStack(k.uniqueSort(k.merge(this.get(), k(e, t))));
    },
    addBack: function addBack(e) {
      return this.add(null == e ? this.prevObject : this.prevObject.filter(e));
    }
  }), k.each({
    parent: function parent(e) {
      var t = e.parentNode;
      return t && 11 !== t.nodeType ? t : null;
    },
    parents: function parents(e) {
      return T(e, "parentNode");
    },
    parentsUntil: function parentsUntil(e, t, n) {
      return T(e, "parentNode", n);
    },
    next: function next(e) {
      return P(e, "nextSibling");
    },
    prev: function prev(e) {
      return P(e, "previousSibling");
    },
    nextAll: function nextAll(e) {
      return T(e, "nextSibling");
    },
    prevAll: function prevAll(e) {
      return T(e, "previousSibling");
    },
    nextUntil: function nextUntil(e, t, n) {
      return T(e, "nextSibling", n);
    },
    prevUntil: function prevUntil(e, t, n) {
      return T(e, "previousSibling", n);
    },
    siblings: function siblings(e) {
      return S((e.parentNode || {}).firstChild, e);
    },
    children: function children(e) {
      return S(e.firstChild);
    },
    contents: function contents(e) {
      return "undefined" != typeof e.contentDocument ? e.contentDocument : (A(e, "template") && (e = e.content || e), k.merge([], e.childNodes));
    }
  }, function (r, i) {
    k.fn[r] = function (e, t) {
      var n = k.map(this, i, e);
      return "Until" !== r.slice(-5) && (t = e), t && "string" == typeof t && (n = k.filter(t, n)), 1 < this.length && (O[r] || k.uniqueSort(n), H.test(r) && n.reverse()), this.pushStack(n);
    };
  });
  var R = /[^\x20\t\r\n\f]+/g;
  function M(e) {
    return e;
  }
  function I(e) {
    throw e;
  }
  function W(e, t, n, r) {
    var i;
    try {
      e && m(i = e.promise) ? i.call(e).done(t).fail(n) : e && m(i = e.then) ? i.call(e, t, n) : t.apply(void 0, [e].slice(r));
    } catch (e) {
      n.apply(void 0, [e]);
    }
  }
  k.Callbacks = function (r) {
    var e, n;
    r = "string" == typeof r ? (e = r, n = {}, k.each(e.match(R) || [], function (e, t) {
      n[t] = !0;
    }), n) : k.extend({}, r);
    var i,
      t,
      o,
      a,
      s = [],
      u = [],
      l = -1,
      c = function c() {
        for (a = a || r.once, o = i = !0; u.length; l = -1) {
          t = u.shift();
          while (++l < s.length) !1 === s[l].apply(t[0], t[1]) && r.stopOnFalse && (l = s.length, t = !1);
        }
        r.memory || (t = !1), i = !1, a && (s = t ? [] : "");
      },
      f = {
        add: function add() {
          return s && (t && !i && (l = s.length - 1, u.push(t)), function n(e) {
            k.each(e, function (e, t) {
              m(t) ? r.unique && f.has(t) || s.push(t) : t && t.length && "string" !== w(t) && n(t);
            });
          }(arguments), t && !i && c()), this;
        },
        remove: function remove() {
          return k.each(arguments, function (e, t) {
            var n;
            while (-1 < (n = k.inArray(t, s, n))) s.splice(n, 1), n <= l && l--;
          }), this;
        },
        has: function has(e) {
          return e ? -1 < k.inArray(e, s) : 0 < s.length;
        },
        empty: function empty() {
          return s && (s = []), this;
        },
        disable: function disable() {
          return a = u = [], s = t = "", this;
        },
        disabled: function disabled() {
          return !s;
        },
        lock: function lock() {
          return a = u = [], t || i || (s = t = ""), this;
        },
        locked: function locked() {
          return !!a;
        },
        fireWith: function fireWith(e, t) {
          return a || (t = [e, (t = t || []).slice ? t.slice() : t], u.push(t), i || c()), this;
        },
        fire: function fire() {
          return f.fireWith(this, arguments), this;
        },
        fired: function fired() {
          return !!o;
        }
      };
    return f;
  }, k.extend({
    Deferred: function Deferred(e) {
      var o = [["notify", "progress", k.Callbacks("memory"), k.Callbacks("memory"), 2], ["resolve", "done", k.Callbacks("once memory"), k.Callbacks("once memory"), 0, "resolved"], ["reject", "fail", k.Callbacks("once memory"), k.Callbacks("once memory"), 1, "rejected"]],
        i = "pending",
        a = {
          state: function state() {
            return i;
          },
          always: function always() {
            return s.done(arguments).fail(arguments), this;
          },
          "catch": function _catch(e) {
            return a.then(null, e);
          },
          pipe: function pipe() {
            var i = arguments;
            return k.Deferred(function (r) {
              k.each(o, function (e, t) {
                var n = m(i[t[4]]) && i[t[4]];
                s[t[1]](function () {
                  var e = n && n.apply(this, arguments);
                  e && m(e.promise) ? e.promise().progress(r.notify).done(r.resolve).fail(r.reject) : r[t[0] + "With"](this, n ? [e] : arguments);
                });
              }), i = null;
            }).promise();
          },
          then: function then(t, n, r) {
            var u = 0;
            function l(i, o, a, s) {
              return function () {
                var n = this,
                  r = arguments,
                  e = function e() {
                    var e, t;
                    if (!(i < u)) {
                      if ((e = a.apply(n, r)) === o.promise()) throw new TypeError("Thenable self-resolution");
                      t = e && ("object" == _typeof(e) || "function" == typeof e) && e.then, m(t) ? s ? t.call(e, l(u, o, M, s), l(u, o, I, s)) : (u++, t.call(e, l(u, o, M, s), l(u, o, I, s), l(u, o, M, o.notifyWith))) : (a !== M && (n = void 0, r = [e]), (s || o.resolveWith)(n, r));
                    }
                  },
                  t = s ? e : function () {
                    try {
                      e();
                    } catch (e) {
                      k.Deferred.exceptionHook && k.Deferred.exceptionHook(e, t.stackTrace), u <= i + 1 && (a !== I && (n = void 0, r = [e]), o.rejectWith(n, r));
                    }
                  };
                i ? t() : (k.Deferred.getStackHook && (t.stackTrace = k.Deferred.getStackHook()), C.setTimeout(t));
              };
            }
            return k.Deferred(function (e) {
              o[0][3].add(l(0, e, m(r) ? r : M, e.notifyWith)), o[1][3].add(l(0, e, m(t) ? t : M)), o[2][3].add(l(0, e, m(n) ? n : I));
            }).promise();
          },
          promise: function promise(e) {
            return null != e ? k.extend(e, a) : a;
          }
        },
        s = {};
      return k.each(o, function (e, t) {
        var n = t[2],
          r = t[5];
        a[t[1]] = n.add, r && n.add(function () {
          i = r;
        }, o[3 - e][2].disable, o[3 - e][3].disable, o[0][2].lock, o[0][3].lock), n.add(t[3].fire), s[t[0]] = function () {
          return s[t[0] + "With"](this === s ? void 0 : this, arguments), this;
        }, s[t[0] + "With"] = n.fireWith;
      }), a.promise(s), e && e.call(s, s), s;
    },
    when: function when(e) {
      var n = arguments.length,
        t = n,
        r = Array(t),
        i = s.call(arguments),
        o = k.Deferred(),
        a = function a(t) {
          return function (e) {
            r[t] = this, i[t] = 1 < arguments.length ? s.call(arguments) : e, --n || o.resolveWith(r, i);
          };
        };
      if (n <= 1 && (W(e, o.done(a(t)).resolve, o.reject, !n), "pending" === o.state() || m(i[t] && i[t].then))) return o.then();
      while (t--) W(i[t], a(t), o.reject);
      return o.promise();
    }
  });
  var $ = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;
  k.Deferred.exceptionHook = function (e, t) {
    C.console && C.console.warn && e && $.test(e.name) && C.console.warn("jQuery.Deferred exception: " + e.message, e.stack, t);
  }, k.readyException = function (e) {
    C.setTimeout(function () {
      throw e;
    });
  };
  var F = k.Deferred();
  function B() {
    E.removeEventListener("DOMContentLoaded", B), C.removeEventListener("load", B), k.ready();
  }
  k.fn.ready = function (e) {
    return F.then(e)["catch"](function (e) {
      k.readyException(e);
    }), this;
  }, k.extend({
    isReady: !1,
    readyWait: 1,
    ready: function ready(e) {
      (!0 === e ? --k.readyWait : k.isReady) || (k.isReady = !0) !== e && 0 < --k.readyWait || F.resolveWith(E, [k]);
    }
  }), k.ready.then = F.then, "complete" === E.readyState || "loading" !== E.readyState && !E.documentElement.doScroll ? C.setTimeout(k.ready) : (E.addEventListener("DOMContentLoaded", B), C.addEventListener("load", B));
  var _ = function _(e, t, n, r, i, o, a) {
      var s = 0,
        u = e.length,
        l = null == n;
      if ("object" === w(n)) for (s in i = !0, n) _(e, t, s, n[s], !0, o, a);else if (void 0 !== r && (i = !0, m(r) || (a = !0), l && (a ? (t.call(e, r), t = null) : (l = t, t = function t(e, _t2, n) {
        return l.call(k(e), n);
      })), t)) for (; s < u; s++) t(e[s], n, a ? r : r.call(e[s], s, t(e[s], n)));
      return i ? e : l ? t.call(e) : u ? t(e[0], n) : o;
    },
    z = /^-ms-/,
    U = /-([a-z])/g;
  function X(e, t) {
    return t.toUpperCase();
  }
  function V(e) {
    return e.replace(z, "ms-").replace(U, X);
  }
  var G = function G(e) {
    return 1 === e.nodeType || 9 === e.nodeType || !+e.nodeType;
  };
  function Y() {
    this.expando = k.expando + Y.uid++;
  }
  Y.uid = 1, Y.prototype = {
    cache: function cache(e) {
      var t = e[this.expando];
      return t || (t = {}, G(e) && (e.nodeType ? e[this.expando] = t : Object.defineProperty(e, this.expando, {
        value: t,
        configurable: !0
      }))), t;
    },
    set: function set(e, t, n) {
      var r,
        i = this.cache(e);
      if ("string" == typeof t) i[V(t)] = n;else for (r in t) i[V(r)] = t[r];
      return i;
    },
    get: function get(e, t) {
      return void 0 === t ? this.cache(e) : e[this.expando] && e[this.expando][V(t)];
    },
    access: function access(e, t, n) {
      return void 0 === t || t && "string" == typeof t && void 0 === n ? this.get(e, t) : (this.set(e, t, n), void 0 !== n ? n : t);
    },
    remove: function remove(e, t) {
      var n,
        r = e[this.expando];
      if (void 0 !== r) {
        if (void 0 !== t) {
          n = (t = Array.isArray(t) ? t.map(V) : (t = V(t)) in r ? [t] : t.match(R) || []).length;
          while (n--) delete r[t[n]];
        }
        (void 0 === t || k.isEmptyObject(r)) && (e.nodeType ? e[this.expando] = void 0 : delete e[this.expando]);
      }
    },
    hasData: function hasData(e) {
      var t = e[this.expando];
      return void 0 !== t && !k.isEmptyObject(t);
    }
  };
  var Q = new Y(),
    J = new Y(),
    K = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
    Z = /[A-Z]/g;
  function ee(e, t, n) {
    var r, i;
    if (void 0 === n && 1 === e.nodeType) if (r = "data-" + t.replace(Z, "-$&").toLowerCase(), "string" == typeof (n = e.getAttribute(r))) {
      try {
        n = "true" === (i = n) || "false" !== i && ("null" === i ? null : i === +i + "" ? +i : K.test(i) ? JSON.parse(i) : i);
      } catch (e) {}
      J.set(e, t, n);
    } else n = void 0;
    return n;
  }
  k.extend({
    hasData: function hasData(e) {
      return J.hasData(e) || Q.hasData(e);
    },
    data: function data(e, t, n) {
      return J.access(e, t, n);
    },
    removeData: function removeData(e, t) {
      J.remove(e, t);
    },
    _data: function _data(e, t, n) {
      return Q.access(e, t, n);
    },
    _removeData: function _removeData(e, t) {
      Q.remove(e, t);
    }
  }), k.fn.extend({
    data: function data(n, e) {
      var t,
        r,
        i,
        o = this[0],
        a = o && o.attributes;
      if (void 0 === n) {
        if (this.length && (i = J.get(o), 1 === o.nodeType && !Q.get(o, "hasDataAttrs"))) {
          t = a.length;
          while (t--) a[t] && 0 === (r = a[t].name).indexOf("data-") && (r = V(r.slice(5)), ee(o, r, i[r]));
          Q.set(o, "hasDataAttrs", !0);
        }
        return i;
      }
      return "object" == _typeof(n) ? this.each(function () {
        J.set(this, n);
      }) : _(this, function (e) {
        var t;
        if (o && void 0 === e) return void 0 !== (t = J.get(o, n)) ? t : void 0 !== (t = ee(o, n)) ? t : void 0;
        this.each(function () {
          J.set(this, n, e);
        });
      }, null, e, 1 < arguments.length, null, !0);
    },
    removeData: function removeData(e) {
      return this.each(function () {
        J.remove(this, e);
      });
    }
  }), k.extend({
    queue: function queue(e, t, n) {
      var r;
      if (e) return t = (t || "fx") + "queue", r = Q.get(e, t), n && (!r || Array.isArray(n) ? r = Q.access(e, t, k.makeArray(n)) : r.push(n)), r || [];
    },
    dequeue: function dequeue(e, t) {
      t = t || "fx";
      var n = k.queue(e, t),
        r = n.length,
        i = n.shift(),
        o = k._queueHooks(e, t);
      "inprogress" === i && (i = n.shift(), r--), i && ("fx" === t && n.unshift("inprogress"), delete o.stop, i.call(e, function () {
        k.dequeue(e, t);
      }, o)), !r && o && o.empty.fire();
    },
    _queueHooks: function _queueHooks(e, t) {
      var n = t + "queueHooks";
      return Q.get(e, n) || Q.access(e, n, {
        empty: k.Callbacks("once memory").add(function () {
          Q.remove(e, [t + "queue", n]);
        })
      });
    }
  }), k.fn.extend({
    queue: function queue(t, n) {
      var e = 2;
      return "string" != typeof t && (n = t, t = "fx", e--), arguments.length < e ? k.queue(this[0], t) : void 0 === n ? this : this.each(function () {
        var e = k.queue(this, t, n);
        k._queueHooks(this, t), "fx" === t && "inprogress" !== e[0] && k.dequeue(this, t);
      });
    },
    dequeue: function dequeue(e) {
      return this.each(function () {
        k.dequeue(this, e);
      });
    },
    clearQueue: function clearQueue(e) {
      return this.queue(e || "fx", []);
    },
    promise: function promise(e, t) {
      var n,
        r = 1,
        i = k.Deferred(),
        o = this,
        a = this.length,
        s = function s() {
          --r || i.resolveWith(o, [o]);
        };
      "string" != typeof e && (t = e, e = void 0), e = e || "fx";
      while (a--) (n = Q.get(o[a], e + "queueHooks")) && n.empty && (r++, n.empty.add(s));
      return s(), i.promise(t);
    }
  });
  var te = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
    ne = new RegExp("^(?:([+-])=|)(" + te + ")([a-z%]*)$", "i"),
    re = ["Top", "Right", "Bottom", "Left"],
    ie = E.documentElement,
    oe = function oe(e) {
      return k.contains(e.ownerDocument, e);
    },
    ae = {
      composed: !0
    };
  ie.getRootNode && (oe = function oe(e) {
    return k.contains(e.ownerDocument, e) || e.getRootNode(ae) === e.ownerDocument;
  });
  var se = function se(e, t) {
      return "none" === (e = t || e).style.display || "" === e.style.display && oe(e) && "none" === k.css(e, "display");
    },
    ue = function ue(e, t, n, r) {
      var i,
        o,
        a = {};
      for (o in t) a[o] = e.style[o], e.style[o] = t[o];
      for (o in i = n.apply(e, r || []), t) e.style[o] = a[o];
      return i;
    };
  function le(e, t, n, r) {
    var i,
      o,
      a = 20,
      s = r ? function () {
        return r.cur();
      } : function () {
        return k.css(e, t, "");
      },
      u = s(),
      l = n && n[3] || (k.cssNumber[t] ? "" : "px"),
      c = e.nodeType && (k.cssNumber[t] || "px" !== l && +u) && ne.exec(k.css(e, t));
    if (c && c[3] !== l) {
      u /= 2, l = l || c[3], c = +u || 1;
      while (a--) k.style(e, t, c + l), (1 - o) * (1 - (o = s() / u || .5)) <= 0 && (a = 0), c /= o;
      c *= 2, k.style(e, t, c + l), n = n || [];
    }
    return n && (c = +c || +u || 0, i = n[1] ? c + (n[1] + 1) * n[2] : +n[2], r && (r.unit = l, r.start = c, r.end = i)), i;
  }
  var ce = {};
  function fe(e, t) {
    for (var n, r, i, o, a, s, u, l = [], c = 0, f = e.length; c < f; c++) (r = e[c]).style && (n = r.style.display, t ? ("none" === n && (l[c] = Q.get(r, "display") || null, l[c] || (r.style.display = "")), "" === r.style.display && se(r) && (l[c] = (u = a = o = void 0, a = (i = r).ownerDocument, s = i.nodeName, (u = ce[s]) || (o = a.body.appendChild(a.createElement(s)), u = k.css(o, "display"), o.parentNode.removeChild(o), "none" === u && (u = "block"), ce[s] = u)))) : "none" !== n && (l[c] = "none", Q.set(r, "display", n)));
    for (c = 0; c < f; c++) null != l[c] && (e[c].style.display = l[c]);
    return e;
  }
  k.fn.extend({
    show: function show() {
      return fe(this, !0);
    },
    hide: function hide() {
      return fe(this);
    },
    toggle: function toggle(e) {
      return "boolean" == typeof e ? e ? this.show() : this.hide() : this.each(function () {
        se(this) ? k(this).show() : k(this).hide();
      });
    }
  });
  var pe = /^(?:checkbox|radio)$/i,
    de = /<([a-z][^\/\0>\x20\t\r\n\f]*)/i,
    he = /^$|^module$|\/(?:java|ecma)script/i,
    ge = {
      option: [1, "<select multiple='multiple'>", "</select>"],
      thead: [1, "<table>", "</table>"],
      col: [2, "<table><colgroup>", "</colgroup></table>"],
      tr: [2, "<table><tbody>", "</tbody></table>"],
      td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
      _default: [0, "", ""]
    };
  function ve(e, t) {
    var n;
    return n = "undefined" != typeof e.getElementsByTagName ? e.getElementsByTagName(t || "*") : "undefined" != typeof e.querySelectorAll ? e.querySelectorAll(t || "*") : [], void 0 === t || t && A(e, t) ? k.merge([e], n) : n;
  }
  function ye(e, t) {
    for (var n = 0, r = e.length; n < r; n++) Q.set(e[n], "globalEval", !t || Q.get(t[n], "globalEval"));
  }
  ge.optgroup = ge.option, ge.tbody = ge.tfoot = ge.colgroup = ge.caption = ge.thead, ge.th = ge.td;
  var me,
    xe,
    be = /<|&#?\w+;/;
  function we(e, t, n, r, i) {
    for (var o, a, s, u, l, c, f = t.createDocumentFragment(), p = [], d = 0, h = e.length; d < h; d++) if ((o = e[d]) || 0 === o) if ("object" === w(o)) k.merge(p, o.nodeType ? [o] : o);else if (be.test(o)) {
      a = a || f.appendChild(t.createElement("div")), s = (de.exec(o) || ["", ""])[1].toLowerCase(), u = ge[s] || ge._default, a.innerHTML = u[1] + k.htmlPrefilter(o) + u[2], c = u[0];
      while (c--) a = a.lastChild;
      k.merge(p, a.childNodes), (a = f.firstChild).textContent = "";
    } else p.push(t.createTextNode(o));
    f.textContent = "", d = 0;
    while (o = p[d++]) if (r && -1 < k.inArray(o, r)) i && i.push(o);else if (l = oe(o), a = ve(f.appendChild(o), "script"), l && ye(a), n) {
      c = 0;
      while (o = a[c++]) he.test(o.type || "") && n.push(o);
    }
    return f;
  }
  me = E.createDocumentFragment().appendChild(E.createElement("div")), (xe = E.createElement("input")).setAttribute("type", "radio"), xe.setAttribute("checked", "checked"), xe.setAttribute("name", "t"), me.appendChild(xe), y.checkClone = me.cloneNode(!0).cloneNode(!0).lastChild.checked, me.innerHTML = "<textarea>x</textarea>", y.noCloneChecked = !!me.cloneNode(!0).lastChild.defaultValue;
  var Te = /^key/,
    Ce = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
    Ee = /^([^.]*)(?:\.(.+)|)/;
  function ke() {
    return !0;
  }
  function Se() {
    return !1;
  }
  function Ne(e, t) {
    return e === function () {
      try {
        return E.activeElement;
      } catch (e) {}
    }() == ("focus" === t);
  }
  function Ae(e, t, n, r, i, o) {
    var a, s;
    if ("object" == _typeof(t)) {
      for (s in "string" != typeof n && (r = r || n, n = void 0), t) Ae(e, s, n, r, t[s], o);
      return e;
    }
    if (null == r && null == i ? (i = n, r = n = void 0) : null == i && ("string" == typeof n ? (i = r, r = void 0) : (i = r, r = n, n = void 0)), !1 === i) i = Se;else if (!i) return e;
    return 1 === o && (a = i, (i = function i(e) {
      return k().off(e), a.apply(this, arguments);
    }).guid = a.guid || (a.guid = k.guid++)), e.each(function () {
      k.event.add(this, t, i, r, n);
    });
  }
  function De(e, i, o) {
    o ? (Q.set(e, i, !1), k.event.add(e, i, {
      namespace: !1,
      handler: function handler(e) {
        var t,
          n,
          r = Q.get(this, i);
        if (1 & e.isTrigger && this[i]) {
          if (r.length) (k.event.special[i] || {}).delegateType && e.stopPropagation();else if (r = s.call(arguments), Q.set(this, i, r), t = o(this, i), this[i](), r !== (n = Q.get(this, i)) || t ? Q.set(this, i, !1) : n = {}, r !== n) return e.stopImmediatePropagation(), e.preventDefault(), n.value;
        } else r.length && (Q.set(this, i, {
          value: k.event.trigger(k.extend(r[0], k.Event.prototype), r.slice(1), this)
        }), e.stopImmediatePropagation());
      }
    })) : void 0 === Q.get(e, i) && k.event.add(e, i, ke);
  }
  k.event = {
    global: {},
    add: function add(t, e, n, r, i) {
      var o,
        a,
        s,
        u,
        l,
        c,
        f,
        p,
        d,
        h,
        g,
        v = Q.get(t);
      if (v) {
        n.handler && (n = (o = n).handler, i = o.selector), i && k.find.matchesSelector(ie, i), n.guid || (n.guid = k.guid++), (u = v.events) || (u = v.events = {}), (a = v.handle) || (a = v.handle = function (e) {
          return "undefined" != typeof k && k.event.triggered !== e.type ? k.event.dispatch.apply(t, arguments) : void 0;
        }), l = (e = (e || "").match(R) || [""]).length;
        while (l--) d = g = (s = Ee.exec(e[l]) || [])[1], h = (s[2] || "").split(".").sort(), d && (f = k.event.special[d] || {}, d = (i ? f.delegateType : f.bindType) || d, f = k.event.special[d] || {}, c = k.extend({
          type: d,
          origType: g,
          data: r,
          handler: n,
          guid: n.guid,
          selector: i,
          needsContext: i && k.expr.match.needsContext.test(i),
          namespace: h.join(".")
        }, o), (p = u[d]) || ((p = u[d] = []).delegateCount = 0, f.setup && !1 !== f.setup.call(t, r, h, a) || t.addEventListener && t.addEventListener(d, a)), f.add && (f.add.call(t, c), c.handler.guid || (c.handler.guid = n.guid)), i ? p.splice(p.delegateCount++, 0, c) : p.push(c), k.event.global[d] = !0);
      }
    },
    remove: function remove(e, t, n, r, i) {
      var o,
        a,
        s,
        u,
        l,
        c,
        f,
        p,
        d,
        h,
        g,
        v = Q.hasData(e) && Q.get(e);
      if (v && (u = v.events)) {
        l = (t = (t || "").match(R) || [""]).length;
        while (l--) if (d = g = (s = Ee.exec(t[l]) || [])[1], h = (s[2] || "").split(".").sort(), d) {
          f = k.event.special[d] || {}, p = u[d = (r ? f.delegateType : f.bindType) || d] || [], s = s[2] && new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)"), a = o = p.length;
          while (o--) c = p[o], !i && g !== c.origType || n && n.guid !== c.guid || s && !s.test(c.namespace) || r && r !== c.selector && ("**" !== r || !c.selector) || (p.splice(o, 1), c.selector && p.delegateCount--, f.remove && f.remove.call(e, c));
          a && !p.length && (f.teardown && !1 !== f.teardown.call(e, h, v.handle) || k.removeEvent(e, d, v.handle), delete u[d]);
        } else for (d in u) k.event.remove(e, d + t[l], n, r, !0);
        k.isEmptyObject(u) && Q.remove(e, "handle events");
      }
    },
    dispatch: function dispatch(e) {
      var t,
        n,
        r,
        i,
        o,
        a,
        s = k.event.fix(e),
        u = new Array(arguments.length),
        l = (Q.get(this, "events") || {})[s.type] || [],
        c = k.event.special[s.type] || {};
      for (u[0] = s, t = 1; t < arguments.length; t++) u[t] = arguments[t];
      if (s.delegateTarget = this, !c.preDispatch || !1 !== c.preDispatch.call(this, s)) {
        a = k.event.handlers.call(this, s, l), t = 0;
        while ((i = a[t++]) && !s.isPropagationStopped()) {
          s.currentTarget = i.elem, n = 0;
          while ((o = i.handlers[n++]) && !s.isImmediatePropagationStopped()) s.rnamespace && !1 !== o.namespace && !s.rnamespace.test(o.namespace) || (s.handleObj = o, s.data = o.data, void 0 !== (r = ((k.event.special[o.origType] || {}).handle || o.handler).apply(i.elem, u)) && !1 === (s.result = r) && (s.preventDefault(), s.stopPropagation()));
        }
        return c.postDispatch && c.postDispatch.call(this, s), s.result;
      }
    },
    handlers: function handlers(e, t) {
      var n,
        r,
        i,
        o,
        a,
        s = [],
        u = t.delegateCount,
        l = e.target;
      if (u && l.nodeType && !("click" === e.type && 1 <= e.button)) for (; l !== this; l = l.parentNode || this) if (1 === l.nodeType && ("click" !== e.type || !0 !== l.disabled)) {
        for (o = [], a = {}, n = 0; n < u; n++) void 0 === a[i = (r = t[n]).selector + " "] && (a[i] = r.needsContext ? -1 < k(i, this).index(l) : k.find(i, this, null, [l]).length), a[i] && o.push(r);
        o.length && s.push({
          elem: l,
          handlers: o
        });
      }
      return l = this, u < t.length && s.push({
        elem: l,
        handlers: t.slice(u)
      }), s;
    },
    addProp: function addProp(t, e) {
      Object.defineProperty(k.Event.prototype, t, {
        enumerable: !0,
        configurable: !0,
        get: m(e) ? function () {
          if (this.originalEvent) return e(this.originalEvent);
        } : function () {
          if (this.originalEvent) return this.originalEvent[t];
        },
        set: function set(e) {
          Object.defineProperty(this, t, {
            enumerable: !0,
            configurable: !0,
            writable: !0,
            value: e
          });
        }
      });
    },
    fix: function fix(e) {
      return e[k.expando] ? e : new k.Event(e);
    },
    special: {
      load: {
        noBubble: !0
      },
      click: {
        setup: function setup(e) {
          var t = this || e;
          return pe.test(t.type) && t.click && A(t, "input") && De(t, "click", ke), !1;
        },
        trigger: function trigger(e) {
          var t = this || e;
          return pe.test(t.type) && t.click && A(t, "input") && De(t, "click"), !0;
        },
        _default: function _default(e) {
          var t = e.target;
          return pe.test(t.type) && t.click && A(t, "input") && Q.get(t, "click") || A(t, "a");
        }
      },
      beforeunload: {
        postDispatch: function postDispatch(e) {
          void 0 !== e.result && e.originalEvent && (e.originalEvent.returnValue = e.result);
        }
      }
    }
  }, k.removeEvent = function (e, t, n) {
    e.removeEventListener && e.removeEventListener(t, n);
  }, k.Event = function (e, t) {
    if (!(this instanceof k.Event)) return new k.Event(e, t);
    e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || void 0 === e.defaultPrevented && !1 === e.returnValue ? ke : Se, this.target = e.target && 3 === e.target.nodeType ? e.target.parentNode : e.target, this.currentTarget = e.currentTarget, this.relatedTarget = e.relatedTarget) : this.type = e, t && k.extend(this, t), this.timeStamp = e && e.timeStamp || Date.now(), this[k.expando] = !0;
  }, k.Event.prototype = {
    constructor: k.Event,
    isDefaultPrevented: Se,
    isPropagationStopped: Se,
    isImmediatePropagationStopped: Se,
    isSimulated: !1,
    preventDefault: function preventDefault() {
      var e = this.originalEvent;
      this.isDefaultPrevented = ke, e && !this.isSimulated && e.preventDefault();
    },
    stopPropagation: function stopPropagation() {
      var e = this.originalEvent;
      this.isPropagationStopped = ke, e && !this.isSimulated && e.stopPropagation();
    },
    stopImmediatePropagation: function stopImmediatePropagation() {
      var e = this.originalEvent;
      this.isImmediatePropagationStopped = ke, e && !this.isSimulated && e.stopImmediatePropagation(), this.stopPropagation();
    }
  }, k.each({
    altKey: !0,
    bubbles: !0,
    cancelable: !0,
    changedTouches: !0,
    ctrlKey: !0,
    detail: !0,
    eventPhase: !0,
    metaKey: !0,
    pageX: !0,
    pageY: !0,
    shiftKey: !0,
    view: !0,
    "char": !0,
    code: !0,
    charCode: !0,
    key: !0,
    keyCode: !0,
    button: !0,
    buttons: !0,
    clientX: !0,
    clientY: !0,
    offsetX: !0,
    offsetY: !0,
    pointerId: !0,
    pointerType: !0,
    screenX: !0,
    screenY: !0,
    targetTouches: !0,
    toElement: !0,
    touches: !0,
    which: function which(e) {
      var t = e.button;
      return null == e.which && Te.test(e.type) ? null != e.charCode ? e.charCode : e.keyCode : !e.which && void 0 !== t && Ce.test(e.type) ? 1 & t ? 1 : 2 & t ? 3 : 4 & t ? 2 : 0 : e.which;
    }
  }, k.event.addProp), k.each({
    focus: "focusin",
    blur: "focusout"
  }, function (e, t) {
    k.event.special[e] = {
      setup: function setup() {
        return De(this, e, Ne), !1;
      },
      trigger: function trigger() {
        return De(this, e), !0;
      },
      delegateType: t
    };
  }), k.each({
    mouseenter: "mouseover",
    mouseleave: "mouseout",
    pointerenter: "pointerover",
    pointerleave: "pointerout"
  }, function (e, i) {
    k.event.special[e] = {
      delegateType: i,
      bindType: i,
      handle: function handle(e) {
        var t,
          n = e.relatedTarget,
          r = e.handleObj;
        return n && (n === this || k.contains(this, n)) || (e.type = r.origType, t = r.handler.apply(this, arguments), e.type = i), t;
      }
    };
  }), k.fn.extend({
    on: function on(e, t, n, r) {
      return Ae(this, e, t, n, r);
    },
    one: function one(e, t, n, r) {
      return Ae(this, e, t, n, r, 1);
    },
    off: function off(e, t, n) {
      var r, i;
      if (e && e.preventDefault && e.handleObj) return r = e.handleObj, k(e.delegateTarget).off(r.namespace ? r.origType + "." + r.namespace : r.origType, r.selector, r.handler), this;
      if ("object" == _typeof(e)) {
        for (i in e) this.off(i, t, e[i]);
        return this;
      }
      return !1 !== t && "function" != typeof t || (n = t, t = void 0), !1 === n && (n = Se), this.each(function () {
        k.event.remove(this, e, n, t);
      });
    }
  });
  var je = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([a-z][^\/\0>\x20\t\r\n\f]*)[^>]*)\/>/gi,
    qe = /<script|<style|<link/i,
    Le = /checked\s*(?:[^=]|=\s*.checked.)/i,
    He = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;
  function Oe(e, t) {
    return A(e, "table") && A(11 !== t.nodeType ? t : t.firstChild, "tr") && k(e).children("tbody")[0] || e;
  }
  function Pe(e) {
    return e.type = (null !== e.getAttribute("type")) + "/" + e.type, e;
  }
  function Re(e) {
    return "true/" === (e.type || "").slice(0, 5) ? e.type = e.type.slice(5) : e.removeAttribute("type"), e;
  }
  function Me(e, t) {
    var n, r, i, o, a, s, u, l;
    if (1 === t.nodeType) {
      if (Q.hasData(e) && (o = Q.access(e), a = Q.set(t, o), l = o.events)) for (i in delete a.handle, a.events = {}, l) for (n = 0, r = l[i].length; n < r; n++) k.event.add(t, i, l[i][n]);
      J.hasData(e) && (s = J.access(e), u = k.extend({}, s), J.set(t, u));
    }
  }
  function Ie(n, r, i, o) {
    r = g.apply([], r);
    var e,
      t,
      a,
      s,
      u,
      l,
      c = 0,
      f = n.length,
      p = f - 1,
      d = r[0],
      h = m(d);
    if (h || 1 < f && "string" == typeof d && !y.checkClone && Le.test(d)) return n.each(function (e) {
      var t = n.eq(e);
      h && (r[0] = d.call(this, e, t.html())), Ie(t, r, i, o);
    });
    if (f && (t = (e = we(r, n[0].ownerDocument, !1, n, o)).firstChild, 1 === e.childNodes.length && (e = t), t || o)) {
      for (s = (a = k.map(ve(e, "script"), Pe)).length; c < f; c++) u = e, c !== p && (u = k.clone(u, !0, !0), s && k.merge(a, ve(u, "script"))), i.call(n[c], u, c);
      if (s) for (l = a[a.length - 1].ownerDocument, k.map(a, Re), c = 0; c < s; c++) u = a[c], he.test(u.type || "") && !Q.access(u, "globalEval") && k.contains(l, u) && (u.src && "module" !== (u.type || "").toLowerCase() ? k._evalUrl && !u.noModule && k._evalUrl(u.src, {
        nonce: u.nonce || u.getAttribute("nonce")
      }) : b(u.textContent.replace(He, ""), u, l));
    }
    return n;
  }
  function We(e, t, n) {
    for (var r, i = t ? k.filter(t, e) : e, o = 0; null != (r = i[o]); o++) n || 1 !== r.nodeType || k.cleanData(ve(r)), r.parentNode && (n && oe(r) && ye(ve(r, "script")), r.parentNode.removeChild(r));
    return e;
  }
  k.extend({
    htmlPrefilter: function htmlPrefilter(e) {
      return e.replace(je, "<$1></$2>");
    },
    clone: function clone(e, t, n) {
      var r,
        i,
        o,
        a,
        s,
        u,
        l,
        c = e.cloneNode(!0),
        f = oe(e);
      if (!(y.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || k.isXMLDoc(e))) for (a = ve(c), r = 0, i = (o = ve(e)).length; r < i; r++) s = o[r], u = a[r], void 0, "input" === (l = u.nodeName.toLowerCase()) && pe.test(s.type) ? u.checked = s.checked : "input" !== l && "textarea" !== l || (u.defaultValue = s.defaultValue);
      if (t) if (n) for (o = o || ve(e), a = a || ve(c), r = 0, i = o.length; r < i; r++) Me(o[r], a[r]);else Me(e, c);
      return 0 < (a = ve(c, "script")).length && ye(a, !f && ve(e, "script")), c;
    },
    cleanData: function cleanData(e) {
      for (var t, n, r, i = k.event.special, o = 0; void 0 !== (n = e[o]); o++) if (G(n)) {
        if (t = n[Q.expando]) {
          if (t.events) for (r in t.events) i[r] ? k.event.remove(n, r) : k.removeEvent(n, r, t.handle);
          n[Q.expando] = void 0;
        }
        n[J.expando] && (n[J.expando] = void 0);
      }
    }
  }), k.fn.extend({
    detach: function detach(e) {
      return We(this, e, !0);
    },
    remove: function remove(e) {
      return We(this, e);
    },
    text: function text(e) {
      return _(this, function (e) {
        return void 0 === e ? k.text(this) : this.empty().each(function () {
          1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || (this.textContent = e);
        });
      }, null, e, arguments.length);
    },
    append: function append() {
      return Ie(this, arguments, function (e) {
        1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || Oe(this, e).appendChild(e);
      });
    },
    prepend: function prepend() {
      return Ie(this, arguments, function (e) {
        if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
          var t = Oe(this, e);
          t.insertBefore(e, t.firstChild);
        }
      });
    },
    before: function before() {
      return Ie(this, arguments, function (e) {
        this.parentNode && this.parentNode.insertBefore(e, this);
      });
    },
    after: function after() {
      return Ie(this, arguments, function (e) {
        this.parentNode && this.parentNode.insertBefore(e, this.nextSibling);
      });
    },
    empty: function empty() {
      for (var e, t = 0; null != (e = this[t]); t++) 1 === e.nodeType && (k.cleanData(ve(e, !1)), e.textContent = "");
      return this;
    },
    clone: function clone(e, t) {
      return e = null != e && e, t = null == t ? e : t, this.map(function () {
        return k.clone(this, e, t);
      });
    },
    html: function html(e) {
      return _(this, function (e) {
        var t = this[0] || {},
          n = 0,
          r = this.length;
        if (void 0 === e && 1 === t.nodeType) return t.innerHTML;
        if ("string" == typeof e && !qe.test(e) && !ge[(de.exec(e) || ["", ""])[1].toLowerCase()]) {
          e = k.htmlPrefilter(e);
          try {
            for (; n < r; n++) 1 === (t = this[n] || {}).nodeType && (k.cleanData(ve(t, !1)), t.innerHTML = e);
            t = 0;
          } catch (e) {}
        }
        t && this.empty().append(e);
      }, null, e, arguments.length);
    },
    replaceWith: function replaceWith() {
      var n = [];
      return Ie(this, arguments, function (e) {
        var t = this.parentNode;
        k.inArray(this, n) < 0 && (k.cleanData(ve(this)), t && t.replaceChild(e, this));
      }, n);
    }
  }), k.each({
    appendTo: "append",
    prependTo: "prepend",
    insertBefore: "before",
    insertAfter: "after",
    replaceAll: "replaceWith"
  }, function (e, a) {
    k.fn[e] = function (e) {
      for (var t, n = [], r = k(e), i = r.length - 1, o = 0; o <= i; o++) t = o === i ? this : this.clone(!0), k(r[o])[a](t), u.apply(n, t.get());
      return this.pushStack(n);
    };
  });
  var $e = new RegExp("^(" + te + ")(?!px)[a-z%]+$", "i"),
    Fe = function Fe(e) {
      var t = e.ownerDocument.defaultView;
      return t && t.opener || (t = C), t.getComputedStyle(e);
    },
    Be = new RegExp(re.join("|"), "i");
  function _e(e, t, n) {
    var r,
      i,
      o,
      a,
      s = e.style;
    return (n = n || Fe(e)) && ("" !== (a = n.getPropertyValue(t) || n[t]) || oe(e) || (a = k.style(e, t)), !y.pixelBoxStyles() && $e.test(a) && Be.test(t) && (r = s.width, i = s.minWidth, o = s.maxWidth, s.minWidth = s.maxWidth = s.width = a, a = n.width, s.width = r, s.minWidth = i, s.maxWidth = o)), void 0 !== a ? a + "" : a;
  }
  function ze(e, t) {
    return {
      get: function get() {
        if (!e()) return (this.get = t).apply(this, arguments);
        delete this.get;
      }
    };
  }
  !function () {
    function e() {
      if (u) {
        s.style.cssText = "position:absolute;left:-11111px;width:60px;margin-top:1px;padding:0;border:0", u.style.cssText = "position:relative;display:block;box-sizing:border-box;overflow:scroll;margin:auto;border:1px;padding:1px;width:60%;top:1%", ie.appendChild(s).appendChild(u);
        var e = C.getComputedStyle(u);
        n = "1%" !== e.top, a = 12 === t(e.marginLeft), u.style.right = "60%", o = 36 === t(e.right), r = 36 === t(e.width), u.style.position = "absolute", i = 12 === t(u.offsetWidth / 3), ie.removeChild(s), u = null;
      }
    }
    function t(e) {
      return Math.round(parseFloat(e));
    }
    var n,
      r,
      i,
      o,
      a,
      s = E.createElement("div"),
      u = E.createElement("div");
    u.style && (u.style.backgroundClip = "content-box", u.cloneNode(!0).style.backgroundClip = "", y.clearCloneStyle = "content-box" === u.style.backgroundClip, k.extend(y, {
      boxSizingReliable: function boxSizingReliable() {
        return e(), r;
      },
      pixelBoxStyles: function pixelBoxStyles() {
        return e(), o;
      },
      pixelPosition: function pixelPosition() {
        return e(), n;
      },
      reliableMarginLeft: function reliableMarginLeft() {
        return e(), a;
      },
      scrollboxSize: function scrollboxSize() {
        return e(), i;
      }
    }));
  }();
  var Ue = ["Webkit", "Moz", "ms"],
    Xe = E.createElement("div").style,
    Ve = {};
  function Ge(e) {
    var t = k.cssProps[e] || Ve[e];
    return t || (e in Xe ? e : Ve[e] = function (e) {
      var t = e[0].toUpperCase() + e.slice(1),
        n = Ue.length;
      while (n--) if ((e = Ue[n] + t) in Xe) return e;
    }(e) || e);
  }
  var Ye = /^(none|table(?!-c[ea]).+)/,
    Qe = /^--/,
    Je = {
      position: "absolute",
      visibility: "hidden",
      display: "block"
    },
    Ke = {
      letterSpacing: "0",
      fontWeight: "400"
    };
  function Ze(e, t, n) {
    var r = ne.exec(t);
    return r ? Math.max(0, r[2] - (n || 0)) + (r[3] || "px") : t;
  }
  function et(e, t, n, r, i, o) {
    var a = "width" === t ? 1 : 0,
      s = 0,
      u = 0;
    if (n === (r ? "border" : "content")) return 0;
    for (; a < 4; a += 2) "margin" === n && (u += k.css(e, n + re[a], !0, i)), r ? ("content" === n && (u -= k.css(e, "padding" + re[a], !0, i)), "margin" !== n && (u -= k.css(e, "border" + re[a] + "Width", !0, i))) : (u += k.css(e, "padding" + re[a], !0, i), "padding" !== n ? u += k.css(e, "border" + re[a] + "Width", !0, i) : s += k.css(e, "border" + re[a] + "Width", !0, i));
    return !r && 0 <= o && (u += Math.max(0, Math.ceil(e["offset" + t[0].toUpperCase() + t.slice(1)] - o - u - s - .5)) || 0), u;
  }
  function tt(e, t, n) {
    var r = Fe(e),
      i = (!y.boxSizingReliable() || n) && "border-box" === k.css(e, "boxSizing", !1, r),
      o = i,
      a = _e(e, t, r),
      s = "offset" + t[0].toUpperCase() + t.slice(1);
    if ($e.test(a)) {
      if (!n) return a;
      a = "auto";
    }
    return (!y.boxSizingReliable() && i || "auto" === a || !parseFloat(a) && "inline" === k.css(e, "display", !1, r)) && e.getClientRects().length && (i = "border-box" === k.css(e, "boxSizing", !1, r), (o = s in e) && (a = e[s])), (a = parseFloat(a) || 0) + et(e, t, n || (i ? "border" : "content"), o, r, a) + "px";
  }
  function nt(e, t, n, r, i) {
    return new nt.prototype.init(e, t, n, r, i);
  }
  k.extend({
    cssHooks: {
      opacity: {
        get: function get(e, t) {
          if (t) {
            var n = _e(e, "opacity");
            return "" === n ? "1" : n;
          }
        }
      }
    },
    cssNumber: {
      animationIterationCount: !0,
      columnCount: !0,
      fillOpacity: !0,
      flexGrow: !0,
      flexShrink: !0,
      fontWeight: !0,
      gridArea: !0,
      gridColumn: !0,
      gridColumnEnd: !0,
      gridColumnStart: !0,
      gridRow: !0,
      gridRowEnd: !0,
      gridRowStart: !0,
      lineHeight: !0,
      opacity: !0,
      order: !0,
      orphans: !0,
      widows: !0,
      zIndex: !0,
      zoom: !0
    },
    cssProps: {},
    style: function style(e, t, n, r) {
      if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
        var i,
          o,
          a,
          s = V(t),
          u = Qe.test(t),
          l = e.style;
        if (u || (t = Ge(s)), a = k.cssHooks[t] || k.cssHooks[s], void 0 === n) return a && "get" in a && void 0 !== (i = a.get(e, !1, r)) ? i : l[t];
        "string" === (o = _typeof(n)) && (i = ne.exec(n)) && i[1] && (n = le(e, t, i), o = "number"), null != n && n == n && ("number" !== o || u || (n += i && i[3] || (k.cssNumber[s] ? "" : "px")), y.clearCloneStyle || "" !== n || 0 !== t.indexOf("background") || (l[t] = "inherit"), a && "set" in a && void 0 === (n = a.set(e, n, r)) || (u ? l.setProperty(t, n) : l[t] = n));
      }
    },
    css: function css(e, t, n, r) {
      var i,
        o,
        a,
        s = V(t);
      return Qe.test(t) || (t = Ge(s)), (a = k.cssHooks[t] || k.cssHooks[s]) && "get" in a && (i = a.get(e, !0, n)), void 0 === i && (i = _e(e, t, r)), "normal" === i && t in Ke && (i = Ke[t]), "" === n || n ? (o = parseFloat(i), !0 === n || isFinite(o) ? o || 0 : i) : i;
    }
  }), k.each(["height", "width"], function (e, u) {
    k.cssHooks[u] = {
      get: function get(e, t, n) {
        if (t) return !Ye.test(k.css(e, "display")) || e.getClientRects().length && e.getBoundingClientRect().width ? tt(e, u, n) : ue(e, Je, function () {
          return tt(e, u, n);
        });
      },
      set: function set(e, t, n) {
        var r,
          i = Fe(e),
          o = !y.scrollboxSize() && "absolute" === i.position,
          a = (o || n) && "border-box" === k.css(e, "boxSizing", !1, i),
          s = n ? et(e, u, n, a, i) : 0;
        return a && o && (s -= Math.ceil(e["offset" + u[0].toUpperCase() + u.slice(1)] - parseFloat(i[u]) - et(e, u, "border", !1, i) - .5)), s && (r = ne.exec(t)) && "px" !== (r[3] || "px") && (e.style[u] = t, t = k.css(e, u)), Ze(0, t, s);
      }
    };
  }), k.cssHooks.marginLeft = ze(y.reliableMarginLeft, function (e, t) {
    if (t) return (parseFloat(_e(e, "marginLeft")) || e.getBoundingClientRect().left - ue(e, {
      marginLeft: 0
    }, function () {
      return e.getBoundingClientRect().left;
    })) + "px";
  }), k.each({
    margin: "",
    padding: "",
    border: "Width"
  }, function (i, o) {
    k.cssHooks[i + o] = {
      expand: function expand(e) {
        for (var t = 0, n = {}, r = "string" == typeof e ? e.split(" ") : [e]; t < 4; t++) n[i + re[t] + o] = r[t] || r[t - 2] || r[0];
        return n;
      }
    }, "margin" !== i && (k.cssHooks[i + o].set = Ze);
  }), k.fn.extend({
    css: function css(e, t) {
      return _(this, function (e, t, n) {
        var r,
          i,
          o = {},
          a = 0;
        if (Array.isArray(t)) {
          for (r = Fe(e), i = t.length; a < i; a++) o[t[a]] = k.css(e, t[a], !1, r);
          return o;
        }
        return void 0 !== n ? k.style(e, t, n) : k.css(e, t);
      }, e, t, 1 < arguments.length);
    }
  }), ((k.Tween = nt).prototype = {
    constructor: nt,
    init: function init(e, t, n, r, i, o) {
      this.elem = e, this.prop = n, this.easing = i || k.easing._default, this.options = t, this.start = this.now = this.cur(), this.end = r, this.unit = o || (k.cssNumber[n] ? "" : "px");
    },
    cur: function cur() {
      var e = nt.propHooks[this.prop];
      return e && e.get ? e.get(this) : nt.propHooks._default.get(this);
    },
    run: function run(e) {
      var t,
        n = nt.propHooks[this.prop];
      return this.options.duration ? this.pos = t = k.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : this.pos = t = e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : nt.propHooks._default.set(this), this;
    }
  }).init.prototype = nt.prototype, (nt.propHooks = {
    _default: {
      get: function get(e) {
        var t;
        return 1 !== e.elem.nodeType || null != e.elem[e.prop] && null == e.elem.style[e.prop] ? e.elem[e.prop] : (t = k.css(e.elem, e.prop, "")) && "auto" !== t ? t : 0;
      },
      set: function set(e) {
        k.fx.step[e.prop] ? k.fx.step[e.prop](e) : 1 !== e.elem.nodeType || !k.cssHooks[e.prop] && null == e.elem.style[Ge(e.prop)] ? e.elem[e.prop] = e.now : k.style(e.elem, e.prop, e.now + e.unit);
      }
    }
  }).scrollTop = nt.propHooks.scrollLeft = {
    set: function set(e) {
      e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now);
    }
  }, k.easing = {
    linear: function linear(e) {
      return e;
    },
    swing: function swing(e) {
      return .5 - Math.cos(e * Math.PI) / 2;
    },
    _default: "swing"
  }, k.fx = nt.prototype.init, k.fx.step = {};
  var rt,
    it,
    ot,
    at,
    st = /^(?:toggle|show|hide)$/,
    ut = /queueHooks$/;
  function lt() {
    it && (!1 === E.hidden && C.requestAnimationFrame ? C.requestAnimationFrame(lt) : C.setTimeout(lt, k.fx.interval), k.fx.tick());
  }
  function ct() {
    return C.setTimeout(function () {
      rt = void 0;
    }), rt = Date.now();
  }
  function ft(e, t) {
    var n,
      r = 0,
      i = {
        height: e
      };
    for (t = t ? 1 : 0; r < 4; r += 2 - t) i["margin" + (n = re[r])] = i["padding" + n] = e;
    return t && (i.opacity = i.width = e), i;
  }
  function pt(e, t, n) {
    for (var r, i = (dt.tweeners[t] || []).concat(dt.tweeners["*"]), o = 0, a = i.length; o < a; o++) if (r = i[o].call(n, t, e)) return r;
  }
  function dt(o, e, t) {
    var n,
      a,
      r = 0,
      i = dt.prefilters.length,
      s = k.Deferred().always(function () {
        delete u.elem;
      }),
      u = function u() {
        if (a) return !1;
        for (var e = rt || ct(), t = Math.max(0, l.startTime + l.duration - e), n = 1 - (t / l.duration || 0), r = 0, i = l.tweens.length; r < i; r++) l.tweens[r].run(n);
        return s.notifyWith(o, [l, n, t]), n < 1 && i ? t : (i || s.notifyWith(o, [l, 1, 0]), s.resolveWith(o, [l]), !1);
      },
      l = s.promise({
        elem: o,
        props: k.extend({}, e),
        opts: k.extend(!0, {
          specialEasing: {},
          easing: k.easing._default
        }, t),
        originalProperties: e,
        originalOptions: t,
        startTime: rt || ct(),
        duration: t.duration,
        tweens: [],
        createTween: function createTween(e, t) {
          var n = k.Tween(o, l.opts, e, t, l.opts.specialEasing[e] || l.opts.easing);
          return l.tweens.push(n), n;
        },
        stop: function stop(e) {
          var t = 0,
            n = e ? l.tweens.length : 0;
          if (a) return this;
          for (a = !0; t < n; t++) l.tweens[t].run(1);
          return e ? (s.notifyWith(o, [l, 1, 0]), s.resolveWith(o, [l, e])) : s.rejectWith(o, [l, e]), this;
        }
      }),
      c = l.props;
    for (!function (e, t) {
      var n, r, i, o, a;
      for (n in e) if (i = t[r = V(n)], o = e[n], Array.isArray(o) && (i = o[1], o = e[n] = o[0]), n !== r && (e[r] = o, delete e[n]), (a = k.cssHooks[r]) && ("expand" in a)) for (n in o = a.expand(o), delete e[r], o) (n in e) || (e[n] = o[n], t[n] = i);else t[r] = i;
    }(c, l.opts.specialEasing); r < i; r++) if (n = dt.prefilters[r].call(l, o, c, l.opts)) return m(n.stop) && (k._queueHooks(l.elem, l.opts.queue).stop = n.stop.bind(n)), n;
    return k.map(c, pt, l), m(l.opts.start) && l.opts.start.call(o, l), l.progress(l.opts.progress).done(l.opts.done, l.opts.complete).fail(l.opts.fail).always(l.opts.always), k.fx.timer(k.extend(u, {
      elem: o,
      anim: l,
      queue: l.opts.queue
    })), l;
  }
  k.Animation = k.extend(dt, {
    tweeners: {
      "*": [function (e, t) {
        var n = this.createTween(e, t);
        return le(n.elem, e, ne.exec(t), n), n;
      }]
    },
    tweener: function tweener(e, t) {
      m(e) ? (t = e, e = ["*"]) : e = e.match(R);
      for (var n, r = 0, i = e.length; r < i; r++) n = e[r], dt.tweeners[n] = dt.tweeners[n] || [], dt.tweeners[n].unshift(t);
    },
    prefilters: [function (e, t, n) {
      var r,
        i,
        o,
        a,
        s,
        u,
        l,
        c,
        f = "width" in t || "height" in t,
        p = this,
        d = {},
        h = e.style,
        g = e.nodeType && se(e),
        v = Q.get(e, "fxshow");
      for (r in n.queue || (null == (a = k._queueHooks(e, "fx")).unqueued && (a.unqueued = 0, s = a.empty.fire, a.empty.fire = function () {
        a.unqueued || s();
      }), a.unqueued++, p.always(function () {
        p.always(function () {
          a.unqueued--, k.queue(e, "fx").length || a.empty.fire();
        });
      })), t) if (i = t[r], st.test(i)) {
        if (delete t[r], o = o || "toggle" === i, i === (g ? "hide" : "show")) {
          if ("show" !== i || !v || void 0 === v[r]) continue;
          g = !0;
        }
        d[r] = v && v[r] || k.style(e, r);
      }
      if ((u = !k.isEmptyObject(t)) || !k.isEmptyObject(d)) for (r in f && 1 === e.nodeType && (n.overflow = [h.overflow, h.overflowX, h.overflowY], null == (l = v && v.display) && (l = Q.get(e, "display")), "none" === (c = k.css(e, "display")) && (l ? c = l : (fe([e], !0), l = e.style.display || l, c = k.css(e, "display"), fe([e]))), ("inline" === c || "inline-block" === c && null != l) && "none" === k.css(e, "float") && (u || (p.done(function () {
        h.display = l;
      }), null == l && (c = h.display, l = "none" === c ? "" : c)), h.display = "inline-block")), n.overflow && (h.overflow = "hidden", p.always(function () {
        h.overflow = n.overflow[0], h.overflowX = n.overflow[1], h.overflowY = n.overflow[2];
      })), u = !1, d) u || (v ? "hidden" in v && (g = v.hidden) : v = Q.access(e, "fxshow", {
        display: l
      }), o && (v.hidden = !g), g && fe([e], !0), p.done(function () {
        for (r in g || fe([e]), Q.remove(e, "fxshow"), d) k.style(e, r, d[r]);
      })), u = pt(g ? v[r] : 0, r, p), r in v || (v[r] = u.start, g && (u.end = u.start, u.start = 0));
    }],
    prefilter: function prefilter(e, t) {
      t ? dt.prefilters.unshift(e) : dt.prefilters.push(e);
    }
  }), k.speed = function (e, t, n) {
    var r = e && "object" == _typeof(e) ? k.extend({}, e) : {
      complete: n || !n && t || m(e) && e,
      duration: e,
      easing: n && t || t && !m(t) && t
    };
    return k.fx.off ? r.duration = 0 : "number" != typeof r.duration && (r.duration in k.fx.speeds ? r.duration = k.fx.speeds[r.duration] : r.duration = k.fx.speeds._default), null != r.queue && !0 !== r.queue || (r.queue = "fx"), r.old = r.complete, r.complete = function () {
      m(r.old) && r.old.call(this), r.queue && k.dequeue(this, r.queue);
    }, r;
  }, k.fn.extend({
    fadeTo: function fadeTo(e, t, n, r) {
      return this.filter(se).css("opacity", 0).show().end().animate({
        opacity: t
      }, e, n, r);
    },
    animate: function animate(t, e, n, r) {
      var i = k.isEmptyObject(t),
        o = k.speed(e, n, r),
        a = function a() {
          var e = dt(this, k.extend({}, t), o);
          (i || Q.get(this, "finish")) && e.stop(!0);
        };
      return a.finish = a, i || !1 === o.queue ? this.each(a) : this.queue(o.queue, a);
    },
    stop: function stop(i, e, o) {
      var a = function a(e) {
        var t = e.stop;
        delete e.stop, t(o);
      };
      return "string" != typeof i && (o = e, e = i, i = void 0), e && !1 !== i && this.queue(i || "fx", []), this.each(function () {
        var e = !0,
          t = null != i && i + "queueHooks",
          n = k.timers,
          r = Q.get(this);
        if (t) r[t] && r[t].stop && a(r[t]);else for (t in r) r[t] && r[t].stop && ut.test(t) && a(r[t]);
        for (t = n.length; t--;) n[t].elem !== this || null != i && n[t].queue !== i || (n[t].anim.stop(o), e = !1, n.splice(t, 1));
        !e && o || k.dequeue(this, i);
      });
    },
    finish: function finish(a) {
      return !1 !== a && (a = a || "fx"), this.each(function () {
        var e,
          t = Q.get(this),
          n = t[a + "queue"],
          r = t[a + "queueHooks"],
          i = k.timers,
          o = n ? n.length : 0;
        for (t.finish = !0, k.queue(this, a, []), r && r.stop && r.stop.call(this, !0), e = i.length; e--;) i[e].elem === this && i[e].queue === a && (i[e].anim.stop(!0), i.splice(e, 1));
        for (e = 0; e < o; e++) n[e] && n[e].finish && n[e].finish.call(this);
        delete t.finish;
      });
    }
  }), k.each(["toggle", "show", "hide"], function (e, r) {
    var i = k.fn[r];
    k.fn[r] = function (e, t, n) {
      return null == e || "boolean" == typeof e ? i.apply(this, arguments) : this.animate(ft(r, !0), e, t, n);
    };
  }), k.each({
    slideDown: ft("show"),
    slideUp: ft("hide"),
    slideToggle: ft("toggle"),
    fadeIn: {
      opacity: "show"
    },
    fadeOut: {
      opacity: "hide"
    },
    fadeToggle: {
      opacity: "toggle"
    }
  }, function (e, r) {
    k.fn[e] = function (e, t, n) {
      return this.animate(r, e, t, n);
    };
  }), k.timers = [], k.fx.tick = function () {
    var e,
      t = 0,
      n = k.timers;
    for (rt = Date.now(); t < n.length; t++) (e = n[t])() || n[t] !== e || n.splice(t--, 1);
    n.length || k.fx.stop(), rt = void 0;
  }, k.fx.timer = function (e) {
    k.timers.push(e), k.fx.start();
  }, k.fx.interval = 13, k.fx.start = function () {
    it || (it = !0, lt());
  }, k.fx.stop = function () {
    it = null;
  }, k.fx.speeds = {
    slow: 600,
    fast: 200,
    _default: 400
  }, k.fn.delay = function (r, e) {
    return r = k.fx && k.fx.speeds[r] || r, e = e || "fx", this.queue(e, function (e, t) {
      var n = C.setTimeout(e, r);
      t.stop = function () {
        C.clearTimeout(n);
      };
    });
  }, ot = E.createElement("input"), at = E.createElement("select").appendChild(E.createElement("option")), ot.type = "checkbox", y.checkOn = "" !== ot.value, y.optSelected = at.selected, (ot = E.createElement("input")).value = "t", ot.type = "radio", y.radioValue = "t" === ot.value;
  var ht,
    gt = k.expr.attrHandle;
  k.fn.extend({
    attr: function attr(e, t) {
      return _(this, k.attr, e, t, 1 < arguments.length);
    },
    removeAttr: function removeAttr(e) {
      return this.each(function () {
        k.removeAttr(this, e);
      });
    }
  }), k.extend({
    attr: function attr(e, t, n) {
      var r,
        i,
        o = e.nodeType;
      if (3 !== o && 8 !== o && 2 !== o) return "undefined" == typeof e.getAttribute ? k.prop(e, t, n) : (1 === o && k.isXMLDoc(e) || (i = k.attrHooks[t.toLowerCase()] || (k.expr.match.bool.test(t) ? ht : void 0)), void 0 !== n ? null === n ? void k.removeAttr(e, t) : i && "set" in i && void 0 !== (r = i.set(e, n, t)) ? r : (e.setAttribute(t, n + ""), n) : i && "get" in i && null !== (r = i.get(e, t)) ? r : null == (r = k.find.attr(e, t)) ? void 0 : r);
    },
    attrHooks: {
      type: {
        set: function set(e, t) {
          if (!y.radioValue && "radio" === t && A(e, "input")) {
            var n = e.value;
            return e.setAttribute("type", t), n && (e.value = n), t;
          }
        }
      }
    },
    removeAttr: function removeAttr(e, t) {
      var n,
        r = 0,
        i = t && t.match(R);
      if (i && 1 === e.nodeType) while (n = i[r++]) e.removeAttribute(n);
    }
  }), ht = {
    set: function set(e, t, n) {
      return !1 === t ? k.removeAttr(e, n) : e.setAttribute(n, n), n;
    }
  }, k.each(k.expr.match.bool.source.match(/\w+/g), function (e, t) {
    var a = gt[t] || k.find.attr;
    gt[t] = function (e, t, n) {
      var r,
        i,
        o = t.toLowerCase();
      return n || (i = gt[o], gt[o] = r, r = null != a(e, t, n) ? o : null, gt[o] = i), r;
    };
  });
  var vt = /^(?:input|select|textarea|button)$/i,
    yt = /^(?:a|area)$/i;
  function mt(e) {
    return (e.match(R) || []).join(" ");
  }
  function xt(e) {
    return e.getAttribute && e.getAttribute("class") || "";
  }
  function bt(e) {
    return Array.isArray(e) ? e : "string" == typeof e && e.match(R) || [];
  }
  k.fn.extend({
    prop: function prop(e, t) {
      return _(this, k.prop, e, t, 1 < arguments.length);
    },
    removeProp: function removeProp(e) {
      return this.each(function () {
        delete this[k.propFix[e] || e];
      });
    }
  }), k.extend({
    prop: function prop(e, t, n) {
      var r,
        i,
        o = e.nodeType;
      if (3 !== o && 8 !== o && 2 !== o) return 1 === o && k.isXMLDoc(e) || (t = k.propFix[t] || t, i = k.propHooks[t]), void 0 !== n ? i && "set" in i && void 0 !== (r = i.set(e, n, t)) ? r : e[t] = n : i && "get" in i && null !== (r = i.get(e, t)) ? r : e[t];
    },
    propHooks: {
      tabIndex: {
        get: function get(e) {
          var t = k.find.attr(e, "tabindex");
          return t ? parseInt(t, 10) : vt.test(e.nodeName) || yt.test(e.nodeName) && e.href ? 0 : -1;
        }
      }
    },
    propFix: {
      "for": "htmlFor",
      "class": "className"
    }
  }), y.optSelected || (k.propHooks.selected = {
    get: function get(e) {
      var t = e.parentNode;
      return t && t.parentNode && t.parentNode.selectedIndex, null;
    },
    set: function set(e) {
      var t = e.parentNode;
      t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex);
    }
  }), k.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function () {
    k.propFix[this.toLowerCase()] = this;
  }), k.fn.extend({
    addClass: function addClass(t) {
      var e,
        n,
        r,
        i,
        o,
        a,
        s,
        u = 0;
      if (m(t)) return this.each(function (e) {
        k(this).addClass(t.call(this, e, xt(this)));
      });
      if ((e = bt(t)).length) while (n = this[u++]) if (i = xt(n), r = 1 === n.nodeType && " " + mt(i) + " ") {
        a = 0;
        while (o = e[a++]) r.indexOf(" " + o + " ") < 0 && (r += o + " ");
        i !== (s = mt(r)) && n.setAttribute("class", s);
      }
      return this;
    },
    removeClass: function removeClass(t) {
      var e,
        n,
        r,
        i,
        o,
        a,
        s,
        u = 0;
      if (m(t)) return this.each(function (e) {
        k(this).removeClass(t.call(this, e, xt(this)));
      });
      if (!arguments.length) return this.attr("class", "");
      if ((e = bt(t)).length) while (n = this[u++]) if (i = xt(n), r = 1 === n.nodeType && " " + mt(i) + " ") {
        a = 0;
        while (o = e[a++]) while (-1 < r.indexOf(" " + o + " ")) r = r.replace(" " + o + " ", " ");
        i !== (s = mt(r)) && n.setAttribute("class", s);
      }
      return this;
    },
    toggleClass: function toggleClass(i, t) {
      var o = _typeof(i),
        a = "string" === o || Array.isArray(i);
      return "boolean" == typeof t && a ? t ? this.addClass(i) : this.removeClass(i) : m(i) ? this.each(function (e) {
        k(this).toggleClass(i.call(this, e, xt(this), t), t);
      }) : this.each(function () {
        var e, t, n, r;
        if (a) {
          t = 0, n = k(this), r = bt(i);
          while (e = r[t++]) n.hasClass(e) ? n.removeClass(e) : n.addClass(e);
        } else void 0 !== i && "boolean" !== o || ((e = xt(this)) && Q.set(this, "__className__", e), this.setAttribute && this.setAttribute("class", e || !1 === i ? "" : Q.get(this, "__className__") || ""));
      });
    },
    hasClass: function hasClass(e) {
      var t,
        n,
        r = 0;
      t = " " + e + " ";
      while (n = this[r++]) if (1 === n.nodeType && -1 < (" " + mt(xt(n)) + " ").indexOf(t)) return !0;
      return !1;
    }
  });
  var wt = /\r/g;
  k.fn.extend({
    val: function val(n) {
      var r,
        e,
        i,
        t = this[0];
      return arguments.length ? (i = m(n), this.each(function (e) {
        var t;
        1 === this.nodeType && (null == (t = i ? n.call(this, e, k(this).val()) : n) ? t = "" : "number" == typeof t ? t += "" : Array.isArray(t) && (t = k.map(t, function (e) {
          return null == e ? "" : e + "";
        })), (r = k.valHooks[this.type] || k.valHooks[this.nodeName.toLowerCase()]) && "set" in r && void 0 !== r.set(this, t, "value") || (this.value = t));
      })) : t ? (r = k.valHooks[t.type] || k.valHooks[t.nodeName.toLowerCase()]) && "get" in r && void 0 !== (e = r.get(t, "value")) ? e : "string" == typeof (e = t.value) ? e.replace(wt, "") : null == e ? "" : e : void 0;
    }
  }), k.extend({
    valHooks: {
      option: {
        get: function get(e) {
          var t = k.find.attr(e, "value");
          return null != t ? t : mt(k.text(e));
        }
      },
      select: {
        get: function get(e) {
          var t,
            n,
            r,
            i = e.options,
            o = e.selectedIndex,
            a = "select-one" === e.type,
            s = a ? null : [],
            u = a ? o + 1 : i.length;
          for (r = o < 0 ? u : a ? o : 0; r < u; r++) if (((n = i[r]).selected || r === o) && !n.disabled && (!n.parentNode.disabled || !A(n.parentNode, "optgroup"))) {
            if (t = k(n).val(), a) return t;
            s.push(t);
          }
          return s;
        },
        set: function set(e, t) {
          var n,
            r,
            i = e.options,
            o = k.makeArray(t),
            a = i.length;
          while (a--) ((r = i[a]).selected = -1 < k.inArray(k.valHooks.option.get(r), o)) && (n = !0);
          return n || (e.selectedIndex = -1), o;
        }
      }
    }
  }), k.each(["radio", "checkbox"], function () {
    k.valHooks[this] = {
      set: function set(e, t) {
        if (Array.isArray(t)) return e.checked = -1 < k.inArray(k(e).val(), t);
      }
    }, y.checkOn || (k.valHooks[this].get = function (e) {
      return null === e.getAttribute("value") ? "on" : e.value;
    });
  }), y.focusin = "onfocusin" in C;
  var Tt = /^(?:focusinfocus|focusoutblur)$/,
    Ct = function Ct(e) {
      e.stopPropagation();
    };
  k.extend(k.event, {
    trigger: function trigger(e, t, n, r) {
      var i,
        o,
        a,
        s,
        u,
        l,
        c,
        f,
        p = [n || E],
        d = v.call(e, "type") ? e.type : e,
        h = v.call(e, "namespace") ? e.namespace.split(".") : [];
      if (o = f = a = n = n || E, 3 !== n.nodeType && 8 !== n.nodeType && !Tt.test(d + k.event.triggered) && (-1 < d.indexOf(".") && (d = (h = d.split(".")).shift(), h.sort()), u = d.indexOf(":") < 0 && "on" + d, (e = e[k.expando] ? e : new k.Event(d, "object" == _typeof(e) && e)).isTrigger = r ? 2 : 3, e.namespace = h.join("."), e.rnamespace = e.namespace ? new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, e.result = void 0, e.target || (e.target = n), t = null == t ? [e] : k.makeArray(t, [e]), c = k.event.special[d] || {}, r || !c.trigger || !1 !== c.trigger.apply(n, t))) {
        if (!r && !c.noBubble && !x(n)) {
          for (s = c.delegateType || d, Tt.test(s + d) || (o = o.parentNode); o; o = o.parentNode) p.push(o), a = o;
          a === (n.ownerDocument || E) && p.push(a.defaultView || a.parentWindow || C);
        }
        i = 0;
        while ((o = p[i++]) && !e.isPropagationStopped()) f = o, e.type = 1 < i ? s : c.bindType || d, (l = (Q.get(o, "events") || {})[e.type] && Q.get(o, "handle")) && l.apply(o, t), (l = u && o[u]) && l.apply && G(o) && (e.result = l.apply(o, t), !1 === e.result && e.preventDefault());
        return e.type = d, r || e.isDefaultPrevented() || c._default && !1 !== c._default.apply(p.pop(), t) || !G(n) || u && m(n[d]) && !x(n) && ((a = n[u]) && (n[u] = null), k.event.triggered = d, e.isPropagationStopped() && f.addEventListener(d, Ct), n[d](), e.isPropagationStopped() && f.removeEventListener(d, Ct), k.event.triggered = void 0, a && (n[u] = a)), e.result;
      }
    },
    simulate: function simulate(e, t, n) {
      var r = k.extend(new k.Event(), n, {
        type: e,
        isSimulated: !0
      });
      k.event.trigger(r, null, t);
    }
  }), k.fn.extend({
    trigger: function trigger(e, t) {
      return this.each(function () {
        k.event.trigger(e, t, this);
      });
    },
    triggerHandler: function triggerHandler(e, t) {
      var n = this[0];
      if (n) return k.event.trigger(e, t, n, !0);
    }
  }), y.focusin || k.each({
    focus: "focusin",
    blur: "focusout"
  }, function (n, r) {
    var i = function i(e) {
      k.event.simulate(r, e.target, k.event.fix(e));
    };
    k.event.special[r] = {
      setup: function setup() {
        var e = this.ownerDocument || this,
          t = Q.access(e, r);
        t || e.addEventListener(n, i, !0), Q.access(e, r, (t || 0) + 1);
      },
      teardown: function teardown() {
        var e = this.ownerDocument || this,
          t = Q.access(e, r) - 1;
        t ? Q.access(e, r, t) : (e.removeEventListener(n, i, !0), Q.remove(e, r));
      }
    };
  });
  var Et = C.location,
    kt = Date.now(),
    St = /\?/;
  k.parseXML = function (e) {
    var t;
    if (!e || "string" != typeof e) return null;
    try {
      t = new C.DOMParser().parseFromString(e, "text/xml");
    } catch (e) {
      t = void 0;
    }
    return t && !t.getElementsByTagName("parsererror").length || k.error("Invalid XML: " + e), t;
  };
  var Nt = /\[\]$/,
    At = /\r?\n/g,
    Dt = /^(?:submit|button|image|reset|file)$/i,
    jt = /^(?:input|select|textarea|keygen)/i;
  function qt(n, e, r, i) {
    var t;
    if (Array.isArray(e)) k.each(e, function (e, t) {
      r || Nt.test(n) ? i(n, t) : qt(n + "[" + ("object" == _typeof(t) && null != t ? e : "") + "]", t, r, i);
    });else if (r || "object" !== w(e)) i(n, e);else for (t in e) qt(n + "[" + t + "]", e[t], r, i);
  }
  k.param = function (e, t) {
    var n,
      r = [],
      i = function i(e, t) {
        var n = m(t) ? t() : t;
        r[r.length] = encodeURIComponent(e) + "=" + encodeURIComponent(null == n ? "" : n);
      };
    if (null == e) return "";
    if (Array.isArray(e) || e.jquery && !k.isPlainObject(e)) k.each(e, function () {
      i(this.name, this.value);
    });else for (n in e) qt(n, e[n], t, i);
    return r.join("&");
  }, k.fn.extend({
    serialize: function serialize() {
      return k.param(this.serializeArray());
    },
    serializeArray: function serializeArray() {
      return this.map(function () {
        var e = k.prop(this, "elements");
        return e ? k.makeArray(e) : this;
      }).filter(function () {
        var e = this.type;
        return this.name && !k(this).is(":disabled") && jt.test(this.nodeName) && !Dt.test(e) && (this.checked || !pe.test(e));
      }).map(function (e, t) {
        var n = k(this).val();
        return null == n ? null : Array.isArray(n) ? k.map(n, function (e) {
          return {
            name: t.name,
            value: e.replace(At, "\r\n")
          };
        }) : {
          name: t.name,
          value: n.replace(At, "\r\n")
        };
      }).get();
    }
  });
  var Lt = /%20/g,
    Ht = /#.*$/,
    Ot = /([?&])_=[^&]*/,
    Pt = /^(.*?):[ \t]*([^\r\n]*)$/gm,
    Rt = /^(?:GET|HEAD)$/,
    Mt = /^\/\//,
    It = {},
    Wt = {},
    $t = "*/".concat("*"),
    Ft = E.createElement("a");
  function Bt(o) {
    return function (e, t) {
      "string" != typeof e && (t = e, e = "*");
      var n,
        r = 0,
        i = e.toLowerCase().match(R) || [];
      if (m(t)) while (n = i[r++]) "+" === n[0] ? (n = n.slice(1) || "*", (o[n] = o[n] || []).unshift(t)) : (o[n] = o[n] || []).push(t);
    };
  }
  function _t(t, i, o, a) {
    var s = {},
      u = t === Wt;
    function l(e) {
      var r;
      return s[e] = !0, k.each(t[e] || [], function (e, t) {
        var n = t(i, o, a);
        return "string" != typeof n || u || s[n] ? u ? !(r = n) : void 0 : (i.dataTypes.unshift(n), l(n), !1);
      }), r;
    }
    return l(i.dataTypes[0]) || !s["*"] && l("*");
  }
  function zt(e, t) {
    var n,
      r,
      i = k.ajaxSettings.flatOptions || {};
    for (n in t) void 0 !== t[n] && ((i[n] ? e : r || (r = {}))[n] = t[n]);
    return r && k.extend(!0, e, r), e;
  }
  Ft.href = Et.href, k.extend({
    active: 0,
    lastModified: {},
    etag: {},
    ajaxSettings: {
      url: Et.href,
      type: "GET",
      isLocal: /^(?:about|app|app-storage|.+-extension|file|res|widget):$/.test(Et.protocol),
      global: !0,
      processData: !0,
      async: !0,
      contentType: "application/x-www-form-urlencoded; charset=UTF-8",
      accepts: {
        "*": $t,
        text: "text/plain",
        html: "text/html",
        xml: "application/xml, text/xml",
        json: "application/json, text/javascript"
      },
      contents: {
        xml: /\bxml\b/,
        html: /\bhtml/,
        json: /\bjson\b/
      },
      responseFields: {
        xml: "responseXML",
        text: "responseText",
        json: "responseJSON"
      },
      converters: {
        "* text": String,
        "text html": !0,
        "text json": JSON.parse,
        "text xml": k.parseXML
      },
      flatOptions: {
        url: !0,
        context: !0
      }
    },
    ajaxSetup: function ajaxSetup(e, t) {
      return t ? zt(zt(e, k.ajaxSettings), t) : zt(k.ajaxSettings, e);
    },
    ajaxPrefilter: Bt(It),
    ajaxTransport: Bt(Wt),
    ajax: function ajax(e, t) {
      "object" == _typeof(e) && (t = e, e = void 0), t = t || {};
      var c,
        f,
        p,
        n,
        d,
        r,
        h,
        g,
        i,
        o,
        v = k.ajaxSetup({}, t),
        y = v.context || v,
        m = v.context && (y.nodeType || y.jquery) ? k(y) : k.event,
        x = k.Deferred(),
        b = k.Callbacks("once memory"),
        w = v.statusCode || {},
        a = {},
        s = {},
        u = "canceled",
        T = {
          readyState: 0,
          getResponseHeader: function getResponseHeader(e) {
            var t;
            if (h) {
              if (!n) {
                n = {};
                while (t = Pt.exec(p)) n[t[1].toLowerCase() + " "] = (n[t[1].toLowerCase() + " "] || []).concat(t[2]);
              }
              t = n[e.toLowerCase() + " "];
            }
            return null == t ? null : t.join(", ");
          },
          getAllResponseHeaders: function getAllResponseHeaders() {
            return h ? p : null;
          },
          setRequestHeader: function setRequestHeader(e, t) {
            return null == h && (e = s[e.toLowerCase()] = s[e.toLowerCase()] || e, a[e] = t), this;
          },
          overrideMimeType: function overrideMimeType(e) {
            return null == h && (v.mimeType = e), this;
          },
          statusCode: function statusCode(e) {
            var t;
            if (e) if (h) T.always(e[T.status]);else for (t in e) w[t] = [w[t], e[t]];
            return this;
          },
          abort: function abort(e) {
            var t = e || u;
            return c && c.abort(t), l(0, t), this;
          }
        };
      if (x.promise(T), v.url = ((e || v.url || Et.href) + "").replace(Mt, Et.protocol + "//"), v.type = t.method || t.type || v.method || v.type, v.dataTypes = (v.dataType || "*").toLowerCase().match(R) || [""], null == v.crossDomain) {
        r = E.createElement("a");
        try {
          r.href = v.url, r.href = r.href, v.crossDomain = Ft.protocol + "//" + Ft.host != r.protocol + "//" + r.host;
        } catch (e) {
          v.crossDomain = !0;
        }
      }
      if (v.data && v.processData && "string" != typeof v.data && (v.data = k.param(v.data, v.traditional)), _t(It, v, t, T), h) return T;
      for (i in (g = k.event && v.global) && 0 == k.active++ && k.event.trigger("ajaxStart"), v.type = v.type.toUpperCase(), v.hasContent = !Rt.test(v.type), f = v.url.replace(Ht, ""), v.hasContent ? v.data && v.processData && 0 === (v.contentType || "").indexOf("application/x-www-form-urlencoded") && (v.data = v.data.replace(Lt, "+")) : (o = v.url.slice(f.length), v.data && (v.processData || "string" == typeof v.data) && (f += (St.test(f) ? "&" : "?") + v.data, delete v.data), !1 === v.cache && (f = f.replace(Ot, "$1"), o = (St.test(f) ? "&" : "?") + "_=" + kt++ + o), v.url = f + o), v.ifModified && (k.lastModified[f] && T.setRequestHeader("If-Modified-Since", k.lastModified[f]), k.etag[f] && T.setRequestHeader("If-None-Match", k.etag[f])), (v.data && v.hasContent && !1 !== v.contentType || t.contentType) && T.setRequestHeader("Content-Type", v.contentType), T.setRequestHeader("Accept", v.dataTypes[0] && v.accepts[v.dataTypes[0]] ? v.accepts[v.dataTypes[0]] + ("*" !== v.dataTypes[0] ? ", " + $t + "; q=0.01" : "") : v.accepts["*"]), v.headers) T.setRequestHeader(i, v.headers[i]);
      if (v.beforeSend && (!1 === v.beforeSend.call(y, T, v) || h)) return T.abort();
      if (u = "abort", b.add(v.complete), T.done(v.success), T.fail(v.error), c = _t(Wt, v, t, T)) {
        if (T.readyState = 1, g && m.trigger("ajaxSend", [T, v]), h) return T;
        v.async && 0 < v.timeout && (d = C.setTimeout(function () {
          T.abort("timeout");
        }, v.timeout));
        try {
          h = !1, c.send(a, l);
        } catch (e) {
          if (h) throw e;
          l(-1, e);
        }
      } else l(-1, "No Transport");
      function l(e, t, n, r) {
        var i,
          o,
          a,
          s,
          u,
          l = t;
        h || (h = !0, d && C.clearTimeout(d), c = void 0, p = r || "", T.readyState = 0 < e ? 4 : 0, i = 200 <= e && e < 300 || 304 === e, n && (s = function (e, t, n) {
          var r,
            i,
            o,
            a,
            s = e.contents,
            u = e.dataTypes;
          while ("*" === u[0]) u.shift(), void 0 === r && (r = e.mimeType || t.getResponseHeader("Content-Type"));
          if (r) for (i in s) if (s[i] && s[i].test(r)) {
            u.unshift(i);
            break;
          }
          if (u[0] in n) o = u[0];else {
            for (i in n) {
              if (!u[0] || e.converters[i + " " + u[0]]) {
                o = i;
                break;
              }
              a || (a = i);
            }
            o = o || a;
          }
          if (o) return o !== u[0] && u.unshift(o), n[o];
        }(v, T, n)), s = function (e, t, n, r) {
          var i,
            o,
            a,
            s,
            u,
            l = {},
            c = e.dataTypes.slice();
          if (c[1]) for (a in e.converters) l[a.toLowerCase()] = e.converters[a];
          o = c.shift();
          while (o) if (e.responseFields[o] && (n[e.responseFields[o]] = t), !u && r && e.dataFilter && (t = e.dataFilter(t, e.dataType)), u = o, o = c.shift()) if ("*" === o) o = u;else if ("*" !== u && u !== o) {
            if (!(a = l[u + " " + o] || l["* " + o])) for (i in l) if ((s = i.split(" "))[1] === o && (a = l[u + " " + s[0]] || l["* " + s[0]])) {
              !0 === a ? a = l[i] : !0 !== l[i] && (o = s[0], c.unshift(s[1]));
              break;
            }
            if (!0 !== a) if (a && e["throws"]) t = a(t);else try {
              t = a(t);
            } catch (e) {
              return {
                state: "parsererror",
                error: a ? e : "No conversion from " + u + " to " + o
              };
            }
          }
          return {
            state: "success",
            data: t
          };
        }(v, s, T, i), i ? (v.ifModified && ((u = T.getResponseHeader("Last-Modified")) && (k.lastModified[f] = u), (u = T.getResponseHeader("etag")) && (k.etag[f] = u)), 204 === e || "HEAD" === v.type ? l = "nocontent" : 304 === e ? l = "notmodified" : (l = s.state, o = s.data, i = !(a = s.error))) : (a = l, !e && l || (l = "error", e < 0 && (e = 0))), T.status = e, T.statusText = (t || l) + "", i ? x.resolveWith(y, [o, l, T]) : x.rejectWith(y, [T, l, a]), T.statusCode(w), w = void 0, g && m.trigger(i ? "ajaxSuccess" : "ajaxError", [T, v, i ? o : a]), b.fireWith(y, [T, l]), g && (m.trigger("ajaxComplete", [T, v]), --k.active || k.event.trigger("ajaxStop")));
      }
      return T;
    },
    getJSON: function getJSON(e, t, n) {
      return k.get(e, t, n, "json");
    },
    getScript: function getScript(e, t) {
      return k.get(e, void 0, t, "script");
    }
  }), k.each(["get", "post"], function (e, i) {
    k[i] = function (e, t, n, r) {
      return m(t) && (r = r || n, n = t, t = void 0), k.ajax(k.extend({
        url: e,
        type: i,
        dataType: r,
        data: t,
        success: n
      }, k.isPlainObject(e) && e));
    };
  }), k._evalUrl = function (e, t) {
    return k.ajax({
      url: e,
      type: "GET",
      dataType: "script",
      cache: !0,
      async: !1,
      global: !1,
      converters: {
        "text script": function textScript() {}
      },
      dataFilter: function dataFilter(e) {
        k.globalEval(e, t);
      }
    });
  }, k.fn.extend({
    wrapAll: function wrapAll(e) {
      var t;
      return this[0] && (m(e) && (e = e.call(this[0])), t = k(e, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && t.insertBefore(this[0]), t.map(function () {
        var e = this;
        while (e.firstElementChild) e = e.firstElementChild;
        return e;
      }).append(this)), this;
    },
    wrapInner: function wrapInner(n) {
      return m(n) ? this.each(function (e) {
        k(this).wrapInner(n.call(this, e));
      }) : this.each(function () {
        var e = k(this),
          t = e.contents();
        t.length ? t.wrapAll(n) : e.append(n);
      });
    },
    wrap: function wrap(t) {
      var n = m(t);
      return this.each(function (e) {
        k(this).wrapAll(n ? t.call(this, e) : t);
      });
    },
    unwrap: function unwrap(e) {
      return this.parent(e).not("body").each(function () {
        k(this).replaceWith(this.childNodes);
      }), this;
    }
  }), k.expr.pseudos.hidden = function (e) {
    return !k.expr.pseudos.visible(e);
  }, k.expr.pseudos.visible = function (e) {
    return !!(e.offsetWidth || e.offsetHeight || e.getClientRects().length);
  }, k.ajaxSettings.xhr = function () {
    try {
      return new C.XMLHttpRequest();
    } catch (e) {}
  };
  var Ut = {
      0: 200,
      1223: 204
    },
    Xt = k.ajaxSettings.xhr();
  y.cors = !!Xt && "withCredentials" in Xt, y.ajax = Xt = !!Xt, k.ajaxTransport(function (i) {
    var _o, a;
    if (y.cors || Xt && !i.crossDomain) return {
      send: function send(e, t) {
        var n,
          r = i.xhr();
        if (r.open(i.type, i.url, i.async, i.username, i.password), i.xhrFields) for (n in i.xhrFields) r[n] = i.xhrFields[n];
        for (n in i.mimeType && r.overrideMimeType && r.overrideMimeType(i.mimeType), i.crossDomain || e["X-Requested-With"] || (e["X-Requested-With"] = "XMLHttpRequest"), e) r.setRequestHeader(n, e[n]);
        _o = function o(e) {
          return function () {
            _o && (_o = a = r.onload = r.onerror = r.onabort = r.ontimeout = r.onreadystatechange = null, "abort" === e ? r.abort() : "error" === e ? "number" != typeof r.status ? t(0, "error") : t(r.status, r.statusText) : t(Ut[r.status] || r.status, r.statusText, "text" !== (r.responseType || "text") || "string" != typeof r.responseText ? {
              binary: r.response
            } : {
              text: r.responseText
            }, r.getAllResponseHeaders()));
          };
        }, r.onload = _o(), a = r.onerror = r.ontimeout = _o("error"), void 0 !== r.onabort ? r.onabort = a : r.onreadystatechange = function () {
          4 === r.readyState && C.setTimeout(function () {
            _o && a();
          });
        }, _o = _o("abort");
        try {
          r.send(i.hasContent && i.data || null);
        } catch (e) {
          if (_o) throw e;
        }
      },
      abort: function abort() {
        _o && _o();
      }
    };
  }), k.ajaxPrefilter(function (e) {
    e.crossDomain && (e.contents.script = !1);
  }), k.ajaxSetup({
    accepts: {
      script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
    },
    contents: {
      script: /\b(?:java|ecma)script\b/
    },
    converters: {
      "text script": function textScript(e) {
        return k.globalEval(e), e;
      }
    }
  }), k.ajaxPrefilter("script", function (e) {
    void 0 === e.cache && (e.cache = !1), e.crossDomain && (e.type = "GET");
  }), k.ajaxTransport("script", function (n) {
    var r, _i;
    if (n.crossDomain || n.scriptAttrs) return {
      send: function send(e, t) {
        r = k("<script>").attr(n.scriptAttrs || {}).prop({
          charset: n.scriptCharset,
          src: n.url
        }).on("load error", _i = function i(e) {
          r.remove(), _i = null, e && t("error" === e.type ? 404 : 200, e.type);
        }), E.head.appendChild(r[0]);
      },
      abort: function abort() {
        _i && _i();
      }
    };
  });
  var Vt,
    Gt = [],
    Yt = /(=)\?(?=&|$)|\?\?/;
  k.ajaxSetup({
    jsonp: "callback",
    jsonpCallback: function jsonpCallback() {
      var e = Gt.pop() || k.expando + "_" + kt++;
      return this[e] = !0, e;
    }
  }), k.ajaxPrefilter("json jsonp", function (e, t, n) {
    var r,
      i,
      o,
      a = !1 !== e.jsonp && (Yt.test(e.url) ? "url" : "string" == typeof e.data && 0 === (e.contentType || "").indexOf("application/x-www-form-urlencoded") && Yt.test(e.data) && "data");
    if (a || "jsonp" === e.dataTypes[0]) return r = e.jsonpCallback = m(e.jsonpCallback) ? e.jsonpCallback() : e.jsonpCallback, a ? e[a] = e[a].replace(Yt, "$1" + r) : !1 !== e.jsonp && (e.url += (St.test(e.url) ? "&" : "?") + e.jsonp + "=" + r), e.converters["script json"] = function () {
      return o || k.error(r + " was not called"), o[0];
    }, e.dataTypes[0] = "json", i = C[r], C[r] = function () {
      o = arguments;
    }, n.always(function () {
      void 0 === i ? k(C).removeProp(r) : C[r] = i, e[r] && (e.jsonpCallback = t.jsonpCallback, Gt.push(r)), o && m(i) && i(o[0]), o = i = void 0;
    }), "script";
  }), y.createHTMLDocument = ((Vt = E.implementation.createHTMLDocument("").body).innerHTML = "<form></form><form></form>", 2 === Vt.childNodes.length), k.parseHTML = function (e, t, n) {
    return "string" != typeof e ? [] : ("boolean" == typeof t && (n = t, t = !1), t || (y.createHTMLDocument ? ((r = (t = E.implementation.createHTMLDocument("")).createElement("base")).href = E.location.href, t.head.appendChild(r)) : t = E), o = !n && [], (i = D.exec(e)) ? [t.createElement(i[1])] : (i = we([e], t, o), o && o.length && k(o).remove(), k.merge([], i.childNodes)));
    var r, i, o;
  }, k.fn.load = function (e, t, n) {
    var r,
      i,
      o,
      a = this,
      s = e.indexOf(" ");
    return -1 < s && (r = mt(e.slice(s)), e = e.slice(0, s)), m(t) ? (n = t, t = void 0) : t && "object" == _typeof(t) && (i = "POST"), 0 < a.length && k.ajax({
      url: e,
      type: i || "GET",
      dataType: "html",
      data: t
    }).done(function (e) {
      o = arguments, a.html(r ? k("<div>").append(k.parseHTML(e)).find(r) : e);
    }).always(n && function (e, t) {
      a.each(function () {
        n.apply(this, o || [e.responseText, t, e]);
      });
    }), this;
  }, k.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function (e, t) {
    k.fn[t] = function (e) {
      return this.on(t, e);
    };
  }), k.expr.pseudos.animated = function (t) {
    return k.grep(k.timers, function (e) {
      return t === e.elem;
    }).length;
  }, k.offset = {
    setOffset: function setOffset(e, t, n) {
      var r,
        i,
        o,
        a,
        s,
        u,
        l = k.css(e, "position"),
        c = k(e),
        f = {};
      "static" === l && (e.style.position = "relative"), s = c.offset(), o = k.css(e, "top"), u = k.css(e, "left"), ("absolute" === l || "fixed" === l) && -1 < (o + u).indexOf("auto") ? (a = (r = c.position()).top, i = r.left) : (a = parseFloat(o) || 0, i = parseFloat(u) || 0), m(t) && (t = t.call(e, n, k.extend({}, s))), null != t.top && (f.top = t.top - s.top + a), null != t.left && (f.left = t.left - s.left + i), "using" in t ? t.using.call(e, f) : c.css(f);
    }
  }, k.fn.extend({
    offset: function offset(t) {
      if (arguments.length) return void 0 === t ? this : this.each(function (e) {
        k.offset.setOffset(this, t, e);
      });
      var e,
        n,
        r = this[0];
      return r ? r.getClientRects().length ? (e = r.getBoundingClientRect(), n = r.ownerDocument.defaultView, {
        top: e.top + n.pageYOffset,
        left: e.left + n.pageXOffset
      }) : {
        top: 0,
        left: 0
      } : void 0;
    },
    position: function position() {
      if (this[0]) {
        var e,
          t,
          n,
          r = this[0],
          i = {
            top: 0,
            left: 0
          };
        if ("fixed" === k.css(r, "position")) t = r.getBoundingClientRect();else {
          t = this.offset(), n = r.ownerDocument, e = r.offsetParent || n.documentElement;
          while (e && (e === n.body || e === n.documentElement) && "static" === k.css(e, "position")) e = e.parentNode;
          e && e !== r && 1 === e.nodeType && ((i = k(e).offset()).top += k.css(e, "borderTopWidth", !0), i.left += k.css(e, "borderLeftWidth", !0));
        }
        return {
          top: t.top - i.top - k.css(r, "marginTop", !0),
          left: t.left - i.left - k.css(r, "marginLeft", !0)
        };
      }
    },
    offsetParent: function offsetParent() {
      return this.map(function () {
        var e = this.offsetParent;
        while (e && "static" === k.css(e, "position")) e = e.offsetParent;
        return e || ie;
      });
    }
  }), k.each({
    scrollLeft: "pageXOffset",
    scrollTop: "pageYOffset"
  }, function (t, i) {
    var o = "pageYOffset" === i;
    k.fn[t] = function (e) {
      return _(this, function (e, t, n) {
        var r;
        if (x(e) ? r = e : 9 === e.nodeType && (r = e.defaultView), void 0 === n) return r ? r[i] : e[t];
        r ? r.scrollTo(o ? r.pageXOffset : n, o ? n : r.pageYOffset) : e[t] = n;
      }, t, e, arguments.length);
    };
  }), k.each(["top", "left"], function (e, n) {
    k.cssHooks[n] = ze(y.pixelPosition, function (e, t) {
      if (t) return t = _e(e, n), $e.test(t) ? k(e).position()[n] + "px" : t;
    });
  }), k.each({
    Height: "height",
    Width: "width"
  }, function (a, s) {
    k.each({
      padding: "inner" + a,
      content: s,
      "": "outer" + a
    }, function (r, o) {
      k.fn[o] = function (e, t) {
        var n = arguments.length && (r || "boolean" != typeof e),
          i = r || (!0 === e || !0 === t ? "margin" : "border");
        return _(this, function (e, t, n) {
          var r;
          return x(e) ? 0 === o.indexOf("outer") ? e["inner" + a] : e.document.documentElement["client" + a] : 9 === e.nodeType ? (r = e.documentElement, Math.max(e.body["scroll" + a], r["scroll" + a], e.body["offset" + a], r["offset" + a], r["client" + a])) : void 0 === n ? k.css(e, t, i) : k.style(e, t, n, i);
        }, s, n ? e : void 0, n);
      };
    });
  }), k.each("blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(" "), function (e, n) {
    k.fn[n] = function (e, t) {
      return 0 < arguments.length ? this.on(n, null, e, t) : this.trigger(n);
    };
  }), k.fn.extend({
    hover: function hover(e, t) {
      return this.mouseenter(e).mouseleave(t || e);
    }
  }), k.fn.extend({
    bind: function bind(e, t, n) {
      return this.on(e, null, t, n);
    },
    unbind: function unbind(e, t) {
      return this.off(e, null, t);
    },
    delegate: function delegate(e, t, n, r) {
      return this.on(t, e, n, r);
    },
    undelegate: function undelegate(e, t, n) {
      return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n);
    }
  }), k.proxy = function (e, t) {
    var n, r, i;
    if ("string" == typeof t && (n = e[t], t = e, e = n), m(e)) return r = s.call(arguments, 2), (i = function i() {
      return e.apply(t || this, r.concat(s.call(arguments)));
    }).guid = e.guid = e.guid || k.guid++, i;
  }, k.holdReady = function (e) {
    e ? k.readyWait++ : k.ready(!0);
  }, k.isArray = Array.isArray, k.parseJSON = JSON.parse, k.nodeName = A, k.isFunction = m, k.isWindow = x, k.camelCase = V, k.type = w, k.now = Date.now, k.isNumeric = function (e) {
    var t = k.type(e);
    return ("number" === t || "string" === t) && !isNaN(e - parseFloat(e));
  }, "function" == typeof define && define.amd && define("jquery", [], function () {
    return k;
  });
  var Qt = C.jQuery,
    Jt = C.$;
  return k.noConflict = function (e) {
    return C.$ === k && (C.$ = Jt), e && C.jQuery === k && (C.jQuery = Qt), k;
  }, e || (C.jQuery = C.$ = k), k;
});

/*
 Copyright (C) Federico Zivolo 2019
 Distributed under the MIT License (license terms are at http://opensource.org/licenses/MIT).
 */
(function (e, t) {
  'object' == (typeof exports === "undefined" ? "undefined" : _typeof(exports)) && 'undefined' != typeof module ? module.exports = t() : 'function' == typeof define && define.amd ? define(t) : e.Popper = t();
})(this, function () {
  'use strict';

  function e(e) {
    return e && '[object Function]' === {}.toString.call(e);
  }
  function t(e, t) {
    if (1 !== e.nodeType) return [];
    var o = e.ownerDocument.defaultView,
      n = o.getComputedStyle(e, null);
    return t ? n[t] : n;
  }
  function o(e) {
    return 'HTML' === e.nodeName ? e : e.parentNode || e.host;
  }
  function n(e) {
    if (!e) return document.body;
    switch (e.nodeName) {
      case 'HTML':
      case 'BODY':
        return e.ownerDocument.body;
      case '#document':
        return e.body;
    }
    var i = t(e),
      r = i.overflow,
      p = i.overflowX,
      s = i.overflowY;
    return /(auto|scroll|overlay)/.test(r + s + p) ? e : n(o(e));
  }
  function r(e) {
    return 11 === e ? pe : 10 === e ? se : pe || se;
  }
  function p(e) {
    if (!e) return document.documentElement;
    for (var o = r(10) ? document.body : null, n = e.offsetParent || null; n === o && e.nextElementSibling;) n = (e = e.nextElementSibling).offsetParent;
    var i = n && n.nodeName;
    return i && 'BODY' !== i && 'HTML' !== i ? -1 !== ['TH', 'TD', 'TABLE'].indexOf(n.nodeName) && 'static' === t(n, 'position') ? p(n) : n : e ? e.ownerDocument.documentElement : document.documentElement;
  }
  function s(e) {
    var t = e.nodeName;
    return 'BODY' !== t && ('HTML' === t || p(e.firstElementChild) === e);
  }
  function d(e) {
    return null === e.parentNode ? e : d(e.parentNode);
  }
  function a(e, t) {
    if (!e || !e.nodeType || !t || !t.nodeType) return document.documentElement;
    var o = e.compareDocumentPosition(t) & Node.DOCUMENT_POSITION_FOLLOWING,
      n = o ? e : t,
      i = o ? t : e,
      r = document.createRange();
    r.setStart(n, 0), r.setEnd(i, 0);
    var l = r.commonAncestorContainer;
    if (e !== l && t !== l || n.contains(i)) return s(l) ? l : p(l);
    var f = d(e);
    return f.host ? a(f.host, t) : a(e, d(t).host);
  }
  function l(e) {
    var t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : 'top',
      o = 'top' === t ? 'scrollTop' : 'scrollLeft',
      n = e.nodeName;
    if ('BODY' === n || 'HTML' === n) {
      var i = e.ownerDocument.documentElement,
        r = e.ownerDocument.scrollingElement || i;
      return r[o];
    }
    return e[o];
  }
  function f(e, t) {
    var o = 2 < arguments.length && void 0 !== arguments[2] && arguments[2],
      n = l(t, 'top'),
      i = l(t, 'left'),
      r = o ? -1 : 1;
    return e.top += n * r, e.bottom += n * r, e.left += i * r, e.right += i * r, e;
  }
  function m(e, t) {
    var o = 'x' === t ? 'Left' : 'Top',
      n = 'Left' == o ? 'Right' : 'Bottom';
    return parseFloat(e['border' + o + 'Width'], 10) + parseFloat(e['border' + n + 'Width'], 10);
  }
  function h(e, t, o, n) {
    return ee(t['offset' + e], t['scroll' + e], o['client' + e], o['offset' + e], o['scroll' + e], r(10) ? parseInt(o['offset' + e]) + parseInt(n['margin' + ('Height' === e ? 'Top' : 'Left')]) + parseInt(n['margin' + ('Height' === e ? 'Bottom' : 'Right')]) : 0);
  }
  function c(e) {
    var t = e.body,
      o = e.documentElement,
      n = r(10) && getComputedStyle(o);
    return {
      height: h('Height', t, o, n),
      width: h('Width', t, o, n)
    };
  }
  function g(e) {
    return fe({}, e, {
      right: e.left + e.width,
      bottom: e.top + e.height
    });
  }
  function u(e) {
    var o = {};
    try {
      if (r(10)) {
        o = e.getBoundingClientRect();
        var n = l(e, 'top'),
          i = l(e, 'left');
        o.top += n, o.left += i, o.bottom += n, o.right += i;
      } else o = e.getBoundingClientRect();
    } catch (t) {}
    var p = {
        left: o.left,
        top: o.top,
        width: o.right - o.left,
        height: o.bottom - o.top
      },
      s = 'HTML' === e.nodeName ? c(e.ownerDocument) : {},
      d = s.width || e.clientWidth || p.right - p.left,
      a = s.height || e.clientHeight || p.bottom - p.top,
      f = e.offsetWidth - d,
      h = e.offsetHeight - a;
    if (f || h) {
      var u = t(e);
      f -= m(u, 'x'), h -= m(u, 'y'), p.width -= f, p.height -= h;
    }
    return g(p);
  }
  function b(e, o) {
    var i = 2 < arguments.length && void 0 !== arguments[2] && arguments[2],
      p = r(10),
      s = 'HTML' === o.nodeName,
      d = u(e),
      a = u(o),
      l = n(e),
      m = t(o),
      h = parseFloat(m.borderTopWidth, 10),
      c = parseFloat(m.borderLeftWidth, 10);
    i && s && (a.top = ee(a.top, 0), a.left = ee(a.left, 0));
    var b = g({
      top: d.top - a.top - h,
      left: d.left - a.left - c,
      width: d.width,
      height: d.height
    });
    if (b.marginTop = 0, b.marginLeft = 0, !p && s) {
      var w = parseFloat(m.marginTop, 10),
        y = parseFloat(m.marginLeft, 10);
      b.top -= h - w, b.bottom -= h - w, b.left -= c - y, b.right -= c - y, b.marginTop = w, b.marginLeft = y;
    }
    return (p && !i ? o.contains(l) : o === l && 'BODY' !== l.nodeName) && (b = f(b, o)), b;
  }
  function w(e) {
    var t = 1 < arguments.length && void 0 !== arguments[1] && arguments[1],
      o = e.ownerDocument.documentElement,
      n = b(e, o),
      i = ee(o.clientWidth, window.innerWidth || 0),
      r = ee(o.clientHeight, window.innerHeight || 0),
      p = t ? 0 : l(o),
      s = t ? 0 : l(o, 'left'),
      d = {
        top: p - n.top + n.marginTop,
        left: s - n.left + n.marginLeft,
        width: i,
        height: r
      };
    return g(d);
  }
  function y(e) {
    var n = e.nodeName;
    if ('BODY' === n || 'HTML' === n) return !1;
    if ('fixed' === t(e, 'position')) return !0;
    var i = o(e);
    return !!i && y(i);
  }
  function E(e) {
    if (!e || !e.parentElement || r()) return document.documentElement;
    for (var o = e.parentElement; o && 'none' === t(o, 'transform');) o = o.parentElement;
    return o || document.documentElement;
  }
  function v(e, t, i, r) {
    var p = 4 < arguments.length && void 0 !== arguments[4] && arguments[4],
      s = {
        top: 0,
        left: 0
      },
      d = p ? E(e) : a(e, t);
    if ('viewport' === r) s = w(d, p);else {
      var l;
      'scrollParent' === r ? (l = n(o(t)), 'BODY' === l.nodeName && (l = e.ownerDocument.documentElement)) : 'window' === r ? l = e.ownerDocument.documentElement : l = r;
      var f = b(l, d, p);
      if ('HTML' === l.nodeName && !y(d)) {
        var m = c(e.ownerDocument),
          h = m.height,
          g = m.width;
        s.top += f.top - f.marginTop, s.bottom = h + f.top, s.left += f.left - f.marginLeft, s.right = g + f.left;
      } else s = f;
    }
    i = i || 0;
    var u = 'number' == typeof i;
    return s.left += u ? i : i.left || 0, s.top += u ? i : i.top || 0, s.right -= u ? i : i.right || 0, s.bottom -= u ? i : i.bottom || 0, s;
  }
  function x(e) {
    var t = e.width,
      o = e.height;
    return t * o;
  }
  function O(e, t, o, n, i) {
    var r = 5 < arguments.length && void 0 !== arguments[5] ? arguments[5] : 0;
    if (-1 === e.indexOf('auto')) return e;
    var p = v(o, n, r, i),
      s = {
        top: {
          width: p.width,
          height: t.top - p.top
        },
        right: {
          width: p.right - t.right,
          height: p.height
        },
        bottom: {
          width: p.width,
          height: p.bottom - t.bottom
        },
        left: {
          width: t.left - p.left,
          height: p.height
        }
      },
      d = Object.keys(s).map(function (e) {
        return fe({
          key: e
        }, s[e], {
          area: x(s[e])
        });
      }).sort(function (e, t) {
        return t.area - e.area;
      }),
      a = d.filter(function (e) {
        var t = e.width,
          n = e.height;
        return t >= o.clientWidth && n >= o.clientHeight;
      }),
      l = 0 < a.length ? a[0].key : d[0].key,
      f = e.split('-')[1];
    return l + (f ? '-' + f : '');
  }
  function L(e, t, o) {
    var n = 3 < arguments.length && void 0 !== arguments[3] ? arguments[3] : null,
      i = n ? E(t) : a(t, o);
    return b(o, i, n);
  }
  function S(e) {
    var t = e.ownerDocument.defaultView,
      o = t.getComputedStyle(e),
      n = parseFloat(o.marginTop || 0) + parseFloat(o.marginBottom || 0),
      i = parseFloat(o.marginLeft || 0) + parseFloat(o.marginRight || 0),
      r = {
        width: e.offsetWidth + i,
        height: e.offsetHeight + n
      };
    return r;
  }
  function T(e) {
    var t = {
      left: 'right',
      right: 'left',
      bottom: 'top',
      top: 'bottom'
    };
    return e.replace(/left|right|bottom|top/g, function (e) {
      return t[e];
    });
  }
  function D(e, t, o) {
    o = o.split('-')[0];
    var n = S(e),
      i = {
        width: n.width,
        height: n.height
      },
      r = -1 !== ['right', 'left'].indexOf(o),
      p = r ? 'top' : 'left',
      s = r ? 'left' : 'top',
      d = r ? 'height' : 'width',
      a = r ? 'width' : 'height';
    return i[p] = t[p] + t[d] / 2 - n[d] / 2, i[s] = o === s ? t[s] - n[a] : t[T(s)], i;
  }
  function C(e, t) {
    return Array.prototype.find ? e.find(t) : e.filter(t)[0];
  }
  function N(e, t, o) {
    if (Array.prototype.findIndex) return e.findIndex(function (e) {
      return e[t] === o;
    });
    var n = C(e, function (e) {
      return e[t] === o;
    });
    return e.indexOf(n);
  }
  function P(t, o, n) {
    var i = void 0 === n ? t : t.slice(0, N(t, 'name', n));
    return i.forEach(function (t) {
      t['function'] && console.warn('`modifier.function` is deprecated, use `modifier.fn`!');
      var n = t['function'] || t.fn;
      t.enabled && e(n) && (o.offsets.popper = g(o.offsets.popper), o.offsets.reference = g(o.offsets.reference), o = n(o, t));
    }), o;
  }
  function k() {
    if (!this.state.isDestroyed) {
      var e = {
        instance: this,
        styles: {},
        arrowStyles: {},
        attributes: {},
        flipped: !1,
        offsets: {}
      };
      e.offsets.reference = L(this.state, this.popper, this.reference, this.options.positionFixed), e.placement = O(this.options.placement, e.offsets.reference, this.popper, this.reference, this.options.modifiers.flip.boundariesElement, this.options.modifiers.flip.padding), e.originalPlacement = e.placement, e.positionFixed = this.options.positionFixed, e.offsets.popper = D(this.popper, e.offsets.reference, e.placement), e.offsets.popper.position = this.options.positionFixed ? 'fixed' : 'absolute', e = P(this.modifiers, e), this.state.isCreated ? this.options.onUpdate(e) : (this.state.isCreated = !0, this.options.onCreate(e));
    }
  }
  function W(e, t) {
    return e.some(function (e) {
      var o = e.name,
        n = e.enabled;
      return n && o === t;
    });
  }
  function H(e) {
    for (var t = [!1, 'ms', 'Webkit', 'Moz', 'O'], o = e.charAt(0).toUpperCase() + e.slice(1), n = 0; n < t.length; n++) {
      var i = t[n],
        r = i ? '' + i + o : e;
      if ('undefined' != typeof document.body.style[r]) return r;
    }
    return null;
  }
  function B() {
    return this.state.isDestroyed = !0, W(this.modifiers, 'applyStyle') && (this.popper.removeAttribute('x-placement'), this.popper.style.position = '', this.popper.style.top = '', this.popper.style.left = '', this.popper.style.right = '', this.popper.style.bottom = '', this.popper.style.willChange = '', this.popper.style[H('transform')] = ''), this.disableEventListeners(), this.options.removeOnDestroy && this.popper.parentNode.removeChild(this.popper), this;
  }
  function A(e) {
    var t = e.ownerDocument;
    return t ? t.defaultView : window;
  }
  function M(e, t, o, i) {
    var r = 'BODY' === e.nodeName,
      p = r ? e.ownerDocument.defaultView : e;
    p.addEventListener(t, o, {
      passive: !0
    }), r || M(n(p.parentNode), t, o, i), i.push(p);
  }
  function F(e, t, o, i) {
    o.updateBound = i, A(e).addEventListener('resize', o.updateBound, {
      passive: !0
    });
    var r = n(e);
    return M(r, 'scroll', o.updateBound, o.scrollParents), o.scrollElement = r, o.eventsEnabled = !0, o;
  }
  function I() {
    this.state.eventsEnabled || (this.state = F(this.reference, this.options, this.state, this.scheduleUpdate));
  }
  function R(e, t) {
    return A(e).removeEventListener('resize', t.updateBound), t.scrollParents.forEach(function (e) {
      e.removeEventListener('scroll', t.updateBound);
    }), t.updateBound = null, t.scrollParents = [], t.scrollElement = null, t.eventsEnabled = !1, t;
  }
  function U() {
    this.state.eventsEnabled && (cancelAnimationFrame(this.scheduleUpdate), this.state = R(this.reference, this.state));
  }
  function Y(e) {
    return '' !== e && !isNaN(parseFloat(e)) && isFinite(e);
  }
  function j(e, t) {
    Object.keys(t).forEach(function (o) {
      var n = '';
      -1 !== ['width', 'height', 'top', 'right', 'bottom', 'left'].indexOf(o) && Y(t[o]) && (n = 'px'), e.style[o] = t[o] + n;
    });
  }
  function V(e, t) {
    Object.keys(t).forEach(function (o) {
      var n = t[o];
      !1 === n ? e.removeAttribute(o) : e.setAttribute(o, t[o]);
    });
  }
  function q(e, t) {
    var o = e.offsets,
      n = o.popper,
      i = o.reference,
      r = $,
      p = function p(e) {
        return e;
      },
      s = r(i.width),
      d = r(n.width),
      a = -1 !== ['left', 'right'].indexOf(e.placement),
      l = -1 !== e.placement.indexOf('-'),
      f = t ? a || l || s % 2 == d % 2 ? r : Z : p,
      m = t ? r : p;
    return {
      left: f(1 == s % 2 && 1 == d % 2 && !l && t ? n.left - 1 : n.left),
      top: m(n.top),
      bottom: m(n.bottom),
      right: f(n.right)
    };
  }
  function K(e, t, o) {
    var n = C(e, function (e) {
        var o = e.name;
        return o === t;
      }),
      i = !!n && e.some(function (e) {
        return e.name === o && e.enabled && e.order < n.order;
      });
    if (!i) {
      var r = '`' + t + '`';
      console.warn('`' + o + '`' + ' modifier is required by ' + r + ' modifier in order to work, be sure to include it before ' + r + '!');
    }
    return i;
  }
  function z(e) {
    return 'end' === e ? 'start' : 'start' === e ? 'end' : e;
  }
  function G(e) {
    var t = 1 < arguments.length && void 0 !== arguments[1] && arguments[1],
      o = ce.indexOf(e),
      n = ce.slice(o + 1).concat(ce.slice(0, o));
    return t ? n.reverse() : n;
  }
  function _(e, t, o, n) {
    var i = e.match(/((?:\-|\+)?\d*\.?\d*)(.*)/),
      r = +i[1],
      p = i[2];
    if (!r) return e;
    if (0 === p.indexOf('%')) {
      var s;
      switch (p) {
        case '%p':
          s = o;
          break;
        case '%':
        case '%r':
        default:
          s = n;
      }
      var d = g(s);
      return d[t] / 100 * r;
    }
    if ('vh' === p || 'vw' === p) {
      var a;
      return a = 'vh' === p ? ee(document.documentElement.clientHeight, window.innerHeight || 0) : ee(document.documentElement.clientWidth, window.innerWidth || 0), a / 100 * r;
    }
    return r;
  }
  function X(e, t, o, n) {
    var i = [0, 0],
      r = -1 !== ['right', 'left'].indexOf(n),
      p = e.split(/(\+|\-)/).map(function (e) {
        return e.trim();
      }),
      s = p.indexOf(C(p, function (e) {
        return -1 !== e.search(/,|\s/);
      }));
    p[s] && -1 === p[s].indexOf(',') && console.warn('Offsets separated by white space(s) are deprecated, use a comma (,) instead.');
    var d = /\s*,\s*|\s+/,
      a = -1 === s ? [p] : [p.slice(0, s).concat([p[s].split(d)[0]]), [p[s].split(d)[1]].concat(p.slice(s + 1))];
    return a = a.map(function (e, n) {
      var i = (1 === n ? !r : r) ? 'height' : 'width',
        p = !1;
      return e.reduce(function (e, t) {
        return '' === e[e.length - 1] && -1 !== ['+', '-'].indexOf(t) ? (e[e.length - 1] = t, p = !0, e) : p ? (e[e.length - 1] += t, p = !1, e) : e.concat(t);
      }, []).map(function (e) {
        return _(e, i, t, o);
      });
    }), a.forEach(function (e, t) {
      e.forEach(function (o, n) {
        Y(o) && (i[t] += o * ('-' === e[n - 1] ? -1 : 1));
      });
    }), i;
  }
  function J(e, t) {
    var o,
      n = t.offset,
      i = e.placement,
      r = e.offsets,
      p = r.popper,
      s = r.reference,
      d = i.split('-')[0];
    return o = Y(+n) ? [+n, 0] : X(n, p, s, d), 'left' === d ? (p.top += o[0], p.left -= o[1]) : 'right' === d ? (p.top += o[0], p.left += o[1]) : 'top' === d ? (p.left += o[0], p.top -= o[1]) : 'bottom' === d && (p.left += o[0], p.top += o[1]), e.popper = p, e;
  }
  for (var Q = Math.min, Z = Math.floor, $ = Math.round, ee = Math.max, te = 'undefined' != typeof window && 'undefined' != typeof document, oe = ['Edge', 'Trident', 'Firefox'], ne = 0, ie = 0; ie < oe.length; ie += 1) if (te && 0 <= navigator.userAgent.indexOf(oe[ie])) {
    ne = 1;
    break;
  }
  var i = te && window.Promise,
    re = i ? function (e) {
      var t = !1;
      return function () {
        t || (t = !0, window.Promise.resolve().then(function () {
          t = !1, e();
        }));
      };
    } : function (e) {
      var t = !1;
      return function () {
        t || (t = !0, setTimeout(function () {
          t = !1, e();
        }, ne));
      };
    },
    pe = te && !!(window.MSInputMethodContext && document.documentMode),
    se = te && /MSIE 10/.test(navigator.userAgent),
    de = function de(e, t) {
      if (!(e instanceof t)) throw new TypeError('Cannot call a class as a function');
    },
    ae = function () {
      function e(e, t) {
        for (var o, n = 0; n < t.length; n++) o = t[n], o.enumerable = o.enumerable || !1, o.configurable = !0, 'value' in o && (o.writable = !0), Object.defineProperty(e, o.key, o);
      }
      return function (t, o, n) {
        return o && e(t.prototype, o), n && e(t, n), t;
      };
    }(),
    le = function le(e, t, o) {
      return t in e ? Object.defineProperty(e, t, {
        value: o,
        enumerable: !0,
        configurable: !0,
        writable: !0
      }) : e[t] = o, e;
    },
    fe = Object.assign || function (e) {
      for (var t, o = 1; o < arguments.length; o++) for (var n in t = arguments[o], t) Object.prototype.hasOwnProperty.call(t, n) && (e[n] = t[n]);
      return e;
    },
    me = te && /Firefox/i.test(navigator.userAgent),
    he = ['auto-start', 'auto', 'auto-end', 'top-start', 'top', 'top-end', 'right-start', 'right', 'right-end', 'bottom-end', 'bottom', 'bottom-start', 'left-end', 'left', 'left-start'],
    ce = he.slice(3),
    ge = {
      FLIP: 'flip',
      CLOCKWISE: 'clockwise',
      COUNTERCLOCKWISE: 'counterclockwise'
    },
    ue = function () {
      function t(o, n) {
        var i = this,
          r = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : {};
        de(this, t), this.scheduleUpdate = function () {
          return requestAnimationFrame(i.update);
        }, this.update = re(this.update.bind(this)), this.options = fe({}, t.Defaults, r), this.state = {
          isDestroyed: !1,
          isCreated: !1,
          scrollParents: []
        }, this.reference = o && o.jquery ? o[0] : o, this.popper = n && n.jquery ? n[0] : n, this.options.modifiers = {}, Object.keys(fe({}, t.Defaults.modifiers, r.modifiers)).forEach(function (e) {
          i.options.modifiers[e] = fe({}, t.Defaults.modifiers[e] || {}, r.modifiers ? r.modifiers[e] : {});
        }), this.modifiers = Object.keys(this.options.modifiers).map(function (e) {
          return fe({
            name: e
          }, i.options.modifiers[e]);
        }).sort(function (e, t) {
          return e.order - t.order;
        }), this.modifiers.forEach(function (t) {
          t.enabled && e(t.onLoad) && t.onLoad(i.reference, i.popper, i.options, t, i.state);
        }), this.update();
        var p = this.options.eventsEnabled;
        p && this.enableEventListeners(), this.state.eventsEnabled = p;
      }
      return ae(t, [{
        key: 'update',
        value: function value() {
          return k.call(this);
        }
      }, {
        key: 'destroy',
        value: function value() {
          return B.call(this);
        }
      }, {
        key: 'enableEventListeners',
        value: function value() {
          return I.call(this);
        }
      }, {
        key: 'disableEventListeners',
        value: function value() {
          return U.call(this);
        }
      }]), t;
    }();
  return ue.Utils = ('undefined' == typeof window ? global : window).PopperUtils, ue.placements = he, ue.Defaults = {
    placement: 'bottom',
    positionFixed: !1,
    eventsEnabled: !0,
    removeOnDestroy: !1,
    onCreate: function onCreate() {},
    onUpdate: function onUpdate() {},
    modifiers: {
      shift: {
        order: 100,
        enabled: !0,
        fn: function fn(e) {
          var t = e.placement,
            o = t.split('-')[0],
            n = t.split('-')[1];
          if (n) {
            var i = e.offsets,
              r = i.reference,
              p = i.popper,
              s = -1 !== ['bottom', 'top'].indexOf(o),
              d = s ? 'left' : 'top',
              a = s ? 'width' : 'height',
              l = {
                start: le({}, d, r[d]),
                end: le({}, d, r[d] + r[a] - p[a])
              };
            e.offsets.popper = fe({}, p, l[n]);
          }
          return e;
        }
      },
      offset: {
        order: 200,
        enabled: !0,
        fn: J,
        offset: 0
      },
      preventOverflow: {
        order: 300,
        enabled: !0,
        fn: function fn(e, t) {
          var o = t.boundariesElement || p(e.instance.popper);
          e.instance.reference === o && (o = p(o));
          var n = H('transform'),
            i = e.instance.popper.style,
            r = i.top,
            s = i.left,
            d = i[n];
          i.top = '', i.left = '', i[n] = '';
          var a = v(e.instance.popper, e.instance.reference, t.padding, o, e.positionFixed);
          i.top = r, i.left = s, i[n] = d, t.boundaries = a;
          var l = t.priority,
            f = e.offsets.popper,
            m = {
              primary: function primary(e) {
                var o = f[e];
                return f[e] < a[e] && !t.escapeWithReference && (o = ee(f[e], a[e])), le({}, e, o);
              },
              secondary: function secondary(e) {
                var o = 'right' === e ? 'left' : 'top',
                  n = f[o];
                return f[e] > a[e] && !t.escapeWithReference && (n = Q(f[o], a[e] - ('right' === e ? f.width : f.height))), le({}, o, n);
              }
            };
          return l.forEach(function (e) {
            var t = -1 === ['left', 'top'].indexOf(e) ? 'secondary' : 'primary';
            f = fe({}, f, m[t](e));
          }), e.offsets.popper = f, e;
        },
        priority: ['left', 'right', 'top', 'bottom'],
        padding: 5,
        boundariesElement: 'scrollParent'
      },
      keepTogether: {
        order: 400,
        enabled: !0,
        fn: function fn(e) {
          var t = e.offsets,
            o = t.popper,
            n = t.reference,
            i = e.placement.split('-')[0],
            r = Z,
            p = -1 !== ['top', 'bottom'].indexOf(i),
            s = p ? 'right' : 'bottom',
            d = p ? 'left' : 'top',
            a = p ? 'width' : 'height';
          return o[s] < r(n[d]) && (e.offsets.popper[d] = r(n[d]) - o[a]), o[d] > r(n[s]) && (e.offsets.popper[d] = r(n[s])), e;
        }
      },
      arrow: {
        order: 500,
        enabled: !0,
        fn: function fn(e, o) {
          var n;
          if (!K(e.instance.modifiers, 'arrow', 'keepTogether')) return e;
          var i = o.element;
          if ('string' == typeof i) {
            if (i = e.instance.popper.querySelector(i), !i) return e;
          } else if (!e.instance.popper.contains(i)) return console.warn('WARNING: `arrow.element` must be child of its popper element!'), e;
          var r = e.placement.split('-')[0],
            p = e.offsets,
            s = p.popper,
            d = p.reference,
            a = -1 !== ['left', 'right'].indexOf(r),
            l = a ? 'height' : 'width',
            f = a ? 'Top' : 'Left',
            m = f.toLowerCase(),
            h = a ? 'left' : 'top',
            c = a ? 'bottom' : 'right',
            u = S(i)[l];
          d[c] - u < s[m] && (e.offsets.popper[m] -= s[m] - (d[c] - u)), d[m] + u > s[c] && (e.offsets.popper[m] += d[m] + u - s[c]), e.offsets.popper = g(e.offsets.popper);
          var b = d[m] + d[l] / 2 - u / 2,
            w = t(e.instance.popper),
            y = parseFloat(w['margin' + f], 10),
            E = parseFloat(w['border' + f + 'Width'], 10),
            v = b - e.offsets.popper[m] - y - E;
          return v = ee(Q(s[l] - u, v), 0), e.arrowElement = i, e.offsets.arrow = (n = {}, le(n, m, $(v)), le(n, h, ''), n), e;
        },
        element: '[x-arrow]'
      },
      flip: {
        order: 600,
        enabled: !0,
        fn: function fn(e, t) {
          if (W(e.instance.modifiers, 'inner')) return e;
          if (e.flipped && e.placement === e.originalPlacement) return e;
          var o = v(e.instance.popper, e.instance.reference, t.padding, t.boundariesElement, e.positionFixed),
            n = e.placement.split('-')[0],
            i = T(n),
            r = e.placement.split('-')[1] || '',
            p = [];
          switch (t.behavior) {
            case ge.FLIP:
              p = [n, i];
              break;
            case ge.CLOCKWISE:
              p = G(n);
              break;
            case ge.COUNTERCLOCKWISE:
              p = G(n, !0);
              break;
            default:
              p = t.behavior;
          }
          return p.forEach(function (s, d) {
            if (n !== s || p.length === d + 1) return e;
            n = e.placement.split('-')[0], i = T(n);
            var a = e.offsets.popper,
              l = e.offsets.reference,
              f = Z,
              m = 'left' === n && f(a.right) > f(l.left) || 'right' === n && f(a.left) < f(l.right) || 'top' === n && f(a.bottom) > f(l.top) || 'bottom' === n && f(a.top) < f(l.bottom),
              h = f(a.left) < f(o.left),
              c = f(a.right) > f(o.right),
              g = f(a.top) < f(o.top),
              u = f(a.bottom) > f(o.bottom),
              b = 'left' === n && h || 'right' === n && c || 'top' === n && g || 'bottom' === n && u,
              w = -1 !== ['top', 'bottom'].indexOf(n),
              y = !!t.flipVariations && (w && 'start' === r && h || w && 'end' === r && c || !w && 'start' === r && g || !w && 'end' === r && u);
            (m || b || y) && (e.flipped = !0, (m || b) && (n = p[d + 1]), y && (r = z(r)), e.placement = n + (r ? '-' + r : ''), e.offsets.popper = fe({}, e.offsets.popper, D(e.instance.popper, e.offsets.reference, e.placement)), e = P(e.instance.modifiers, e, 'flip'));
          }), e;
        },
        behavior: 'flip',
        padding: 5,
        boundariesElement: 'viewport'
      },
      inner: {
        order: 700,
        enabled: !1,
        fn: function fn(e) {
          var t = e.placement,
            o = t.split('-')[0],
            n = e.offsets,
            i = n.popper,
            r = n.reference,
            p = -1 !== ['left', 'right'].indexOf(o),
            s = -1 === ['top', 'left'].indexOf(o);
          return i[p ? 'left' : 'top'] = r[o] - (s ? i[p ? 'width' : 'height'] : 0), e.placement = T(t), e.offsets.popper = g(i), e;
        }
      },
      hide: {
        order: 800,
        enabled: !0,
        fn: function fn(e) {
          if (!K(e.instance.modifiers, 'hide', 'preventOverflow')) return e;
          var t = e.offsets.reference,
            o = C(e.instance.modifiers, function (e) {
              return 'preventOverflow' === e.name;
            }).boundaries;
          if (t.bottom < o.top || t.left > o.right || t.top > o.bottom || t.right < o.left) {
            if (!0 === e.hide) return e;
            e.hide = !0, e.attributes['x-out-of-boundaries'] = '';
          } else {
            if (!1 === e.hide) return e;
            e.hide = !1, e.attributes['x-out-of-boundaries'] = !1;
          }
          return e;
        }
      },
      computeStyle: {
        order: 850,
        enabled: !0,
        fn: function fn(e, t) {
          var o = t.x,
            n = t.y,
            i = e.offsets.popper,
            r = C(e.instance.modifiers, function (e) {
              return 'applyStyle' === e.name;
            }).gpuAcceleration;
          void 0 !== r && console.warn('WARNING: `gpuAcceleration` option moved to `computeStyle` modifier and will not be supported in future versions of Popper.js!');
          var s,
            d,
            a = void 0 === r ? t.gpuAcceleration : r,
            l = p(e.instance.popper),
            f = u(l),
            m = {
              position: i.position
            },
            h = q(e, 2 > window.devicePixelRatio || !me),
            c = 'bottom' === o ? 'top' : 'bottom',
            g = 'right' === n ? 'left' : 'right',
            b = H('transform');
          if (d = 'bottom' == c ? 'HTML' === l.nodeName ? -l.clientHeight + h.bottom : -f.height + h.bottom : h.top, s = 'right' == g ? 'HTML' === l.nodeName ? -l.clientWidth + h.right : -f.width + h.right : h.left, a && b) m[b] = 'translate3d(' + s + 'px, ' + d + 'px, 0)', m[c] = 0, m[g] = 0, m.willChange = 'transform';else {
            var w = 'bottom' == c ? -1 : 1,
              y = 'right' == g ? -1 : 1;
            m[c] = d * w, m[g] = s * y, m.willChange = c + ', ' + g;
          }
          var E = {
            "x-placement": e.placement
          };
          return e.attributes = fe({}, E, e.attributes), e.styles = fe({}, m, e.styles), e.arrowStyles = fe({}, e.offsets.arrow, e.arrowStyles), e;
        },
        gpuAcceleration: !0,
        x: 'bottom',
        y: 'right'
      },
      applyStyle: {
        order: 900,
        enabled: !0,
        fn: function fn(e) {
          return j(e.instance.popper, e.styles), V(e.instance.popper, e.attributes), e.arrowElement && Object.keys(e.arrowStyles).length && j(e.arrowElement, e.arrowStyles), e;
        },
        onLoad: function onLoad(e, t, o, n, i) {
          var r = L(i, t, e, o.positionFixed),
            p = O(o.placement, r, t, e, o.modifiers.flip.boundariesElement, o.modifiers.flip.padding);
          return t.setAttribute('x-placement', p), j(t, {
            position: o.positionFixed ? 'fixed' : 'absolute'
          }), o;
        },
        gpuAcceleration: void 0
      }
    }
  }, ue;
});

/*!
  * Bootstrap v4.3.1 (https://getbootstrap.com/)
  * Copyright 2011-2019 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
  */
!function (t, e) {
  "object" == (typeof exports === "undefined" ? "undefined" : _typeof(exports)) && "undefined" != typeof module ? e(exports, require("jquery"), require("popper.js")) : "function" == typeof define && define.amd ? define(["exports", "jquery", "popper.js"], e) : e((t = t || self).bootstrap = {}, t.jQuery, t.Popper);
}(this, function (t, g, u) {
  "use strict";

  function i(t, e) {
    for (var n = 0; n < e.length; n++) {
      var i = e[n];
      i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(t, i.key, i);
    }
  }
  function s(t, e, n) {
    return e && i(t.prototype, e), n && i(t, n), t;
  }
  function l(o) {
    for (var t = 1; t < arguments.length; t++) {
      var r = null != arguments[t] ? arguments[t] : {},
        e = Object.keys(r);
      "function" == typeof Object.getOwnPropertySymbols && (e = e.concat(Object.getOwnPropertySymbols(r).filter(function (t) {
        return Object.getOwnPropertyDescriptor(r, t).enumerable;
      }))), e.forEach(function (t) {
        var e, n, i;
        e = o, i = r[n = t], n in e ? Object.defineProperty(e, n, {
          value: i,
          enumerable: !0,
          configurable: !0,
          writable: !0
        }) : e[n] = i;
      });
    }
    return o;
  }
  g = g && g.hasOwnProperty("default") ? g["default"] : g, u = u && u.hasOwnProperty("default") ? u["default"] : u;
  var e = "transitionend";
  function n(t) {
    var e = this,
      n = !1;
    return g(this).one(_.TRANSITION_END, function () {
      n = !0;
    }), setTimeout(function () {
      n || _.triggerTransitionEnd(e);
    }, t), this;
  }
  var _ = {
    TRANSITION_END: "bsTransitionEnd",
    getUID: function getUID(t) {
      for (; t += ~~(1e6 * Math.random()), document.getElementById(t););
      return t;
    },
    getSelectorFromElement: function getSelectorFromElement(t) {
      var e = t.getAttribute("data-target");
      if (!e || "#" === e) {
        var n = t.getAttribute("href");
        e = n && "#" !== n ? n.trim() : "";
      }
      try {
        return document.querySelector(e) ? e : null;
      } catch (t) {
        return null;
      }
    },
    getTransitionDurationFromElement: function getTransitionDurationFromElement(t) {
      if (!t) return 0;
      var e = g(t).css("transition-duration"),
        n = g(t).css("transition-delay"),
        i = parseFloat(e),
        o = parseFloat(n);
      return i || o ? (e = e.split(",")[0], n = n.split(",")[0], 1e3 * (parseFloat(e) + parseFloat(n))) : 0;
    },
    reflow: function reflow(t) {
      return t.offsetHeight;
    },
    triggerTransitionEnd: function triggerTransitionEnd(t) {
      g(t).trigger(e);
    },
    supportsTransitionEnd: function supportsTransitionEnd() {
      return Boolean(e);
    },
    isElement: function isElement(t) {
      return (t[0] || t).nodeType;
    },
    typeCheckConfig: function typeCheckConfig(t, e, n) {
      for (var i in n) if (Object.prototype.hasOwnProperty.call(n, i)) {
        var o = n[i],
          r = e[i],
          s = r && _.isElement(r) ? "element" : (a = r, {}.toString.call(a).match(/\s([a-z]+)/i)[1].toLowerCase());
        if (!new RegExp(o).test(s)) throw new Error(t.toUpperCase() + ': Option "' + i + '" provided type "' + s + '" but expected type "' + o + '".');
      }
      var a;
    },
    findShadowRoot: function findShadowRoot(t) {
      if (!document.documentElement.attachShadow) return null;
      if ("function" != typeof t.getRootNode) return t instanceof ShadowRoot ? t : t.parentNode ? _.findShadowRoot(t.parentNode) : null;
      var e = t.getRootNode();
      return e instanceof ShadowRoot ? e : null;
    }
  };
  g.fn.emulateTransitionEnd = n, g.event.special[_.TRANSITION_END] = {
    bindType: e,
    delegateType: e,
    handle: function handle(t) {
      if (g(t.target).is(this)) return t.handleObj.handler.apply(this, arguments);
    }
  };
  var o = "alert",
    r = "bs.alert",
    a = "." + r,
    c = g.fn[o],
    h = {
      CLOSE: "close" + a,
      CLOSED: "closed" + a,
      CLICK_DATA_API: "click" + a + ".data-api"
    },
    f = "alert",
    d = "fade",
    m = "show",
    p = function () {
      function i(t) {
        this._element = t;
      }
      var t = i.prototype;
      return t.close = function (t) {
        var e = this._element;
        t && (e = this._getRootElement(t)), this._triggerCloseEvent(e).isDefaultPrevented() || this._removeElement(e);
      }, t.dispose = function () {
        g.removeData(this._element, r), this._element = null;
      }, t._getRootElement = function (t) {
        var e = _.getSelectorFromElement(t),
          n = !1;
        return e && (n = document.querySelector(e)), n || (n = g(t).closest("." + f)[0]), n;
      }, t._triggerCloseEvent = function (t) {
        var e = g.Event(h.CLOSE);
        return g(t).trigger(e), e;
      }, t._removeElement = function (e) {
        var n = this;
        if (g(e).removeClass(m), g(e).hasClass(d)) {
          var t = _.getTransitionDurationFromElement(e);
          g(e).one(_.TRANSITION_END, function (t) {
            return n._destroyElement(e, t);
          }).emulateTransitionEnd(t);
        } else this._destroyElement(e);
      }, t._destroyElement = function (t) {
        g(t).detach().trigger(h.CLOSED).remove();
      }, i._jQueryInterface = function (n) {
        return this.each(function () {
          var t = g(this),
            e = t.data(r);
          e || (e = new i(this), t.data(r, e)), "close" === n && e[n](this);
        });
      }, i._handleDismiss = function (e) {
        return function (t) {
          t && t.preventDefault(), e.close(this);
        };
      }, s(i, null, [{
        key: "VERSION",
        get: function get() {
          return "4.3.1";
        }
      }]), i;
    }();
  g(document).on(h.CLICK_DATA_API, '[data-dismiss="alert"]', p._handleDismiss(new p())), g.fn[o] = p._jQueryInterface, g.fn[o].Constructor = p, g.fn[o].noConflict = function () {
    return g.fn[o] = c, p._jQueryInterface;
  };
  var v = "button",
    y = "bs.button",
    E = "." + y,
    C = ".data-api",
    T = g.fn[v],
    S = "active",
    b = "btn",
    I = "focus",
    D = '[data-toggle^="button"]',
    w = '[data-toggle="buttons"]',
    A = 'input:not([type="hidden"])',
    N = ".active",
    O = ".btn",
    k = {
      CLICK_DATA_API: "click" + E + C,
      FOCUS_BLUR_DATA_API: "focus" + E + C + " blur" + E + C
    },
    P = function () {
      function n(t) {
        this._element = t;
      }
      var t = n.prototype;
      return t.toggle = function () {
        var t = !0,
          e = !0,
          n = g(this._element).closest(w)[0];
        if (n) {
          var i = this._element.querySelector(A);
          if (i) {
            if ("radio" === i.type) if (i.checked && this._element.classList.contains(S)) t = !1;else {
              var o = n.querySelector(N);
              o && g(o).removeClass(S);
            }
            if (t) {
              if (i.hasAttribute("disabled") || n.hasAttribute("disabled") || i.classList.contains("disabled") || n.classList.contains("disabled")) return;
              i.checked = !this._element.classList.contains(S), g(i).trigger("change");
            }
            i.focus(), e = !1;
          }
        }
        e && this._element.setAttribute("aria-pressed", !this._element.classList.contains(S)), t && g(this._element).toggleClass(S);
      }, t.dispose = function () {
        g.removeData(this._element, y), this._element = null;
      }, n._jQueryInterface = function (e) {
        return this.each(function () {
          var t = g(this).data(y);
          t || (t = new n(this), g(this).data(y, t)), "toggle" === e && t[e]();
        });
      }, s(n, null, [{
        key: "VERSION",
        get: function get() {
          return "4.3.1";
        }
      }]), n;
    }();
  g(document).on(k.CLICK_DATA_API, D, function (t) {
    t.preventDefault();
    var e = t.target;
    g(e).hasClass(b) || (e = g(e).closest(O)), P._jQueryInterface.call(g(e), "toggle");
  }).on(k.FOCUS_BLUR_DATA_API, D, function (t) {
    var e = g(t.target).closest(O)[0];
    g(e).toggleClass(I, /^focus(in)?$/.test(t.type));
  }), g.fn[v] = P._jQueryInterface, g.fn[v].Constructor = P, g.fn[v].noConflict = function () {
    return g.fn[v] = T, P._jQueryInterface;
  };
  var L = "carousel",
    j = "bs.carousel",
    H = "." + j,
    R = ".data-api",
    x = g.fn[L],
    F = {
      interval: 5e3,
      keyboard: !0,
      slide: !1,
      pause: "hover",
      wrap: !0,
      touch: !0
    },
    U = {
      interval: "(number|boolean)",
      keyboard: "boolean",
      slide: "(boolean|string)",
      pause: "(string|boolean)",
      wrap: "boolean",
      touch: "boolean"
    },
    W = "next",
    q = "prev",
    M = "left",
    K = "right",
    Q = {
      SLIDE: "slide" + H,
      SLID: "slid" + H,
      KEYDOWN: "keydown" + H,
      MOUSEENTER: "mouseenter" + H,
      MOUSELEAVE: "mouseleave" + H,
      TOUCHSTART: "touchstart" + H,
      TOUCHMOVE: "touchmove" + H,
      TOUCHEND: "touchend" + H,
      POINTERDOWN: "pointerdown" + H,
      POINTERUP: "pointerup" + H,
      DRAG_START: "dragstart" + H,
      LOAD_DATA_API: "load" + H + R,
      CLICK_DATA_API: "click" + H + R
    },
    B = "carousel",
    V = "active",
    Y = "slide",
    z = "carousel-item-right",
    X = "carousel-item-left",
    $ = "carousel-item-next",
    G = "carousel-item-prev",
    J = "pointer-event",
    Z = ".active",
    tt = ".active.carousel-item",
    et = ".carousel-item",
    nt = ".carousel-item img",
    it = ".carousel-item-next, .carousel-item-prev",
    ot = ".carousel-indicators",
    rt = "[data-slide], [data-slide-to]",
    st = '[data-ride="carousel"]',
    at = {
      TOUCH: "touch",
      PEN: "pen"
    },
    lt = function () {
      function r(t, e) {
        this._items = null, this._interval = null, this._activeElement = null, this._isPaused = !1, this._isSliding = !1, this.touchTimeout = null, this.touchStartX = 0, this.touchDeltaX = 0, this._config = this._getConfig(e), this._element = t, this._indicatorsElement = this._element.querySelector(ot), this._touchSupported = "ontouchstart" in document.documentElement || 0 < navigator.maxTouchPoints, this._pointerEvent = Boolean(window.PointerEvent || window.MSPointerEvent), this._addEventListeners();
      }
      var t = r.prototype;
      return t.next = function () {
        this._isSliding || this._slide(W);
      }, t.nextWhenVisible = function () {
        !document.hidden && g(this._element).is(":visible") && "hidden" !== g(this._element).css("visibility") && this.next();
      }, t.prev = function () {
        this._isSliding || this._slide(q);
      }, t.pause = function (t) {
        t || (this._isPaused = !0), this._element.querySelector(it) && (_.triggerTransitionEnd(this._element), this.cycle(!0)), clearInterval(this._interval), this._interval = null;
      }, t.cycle = function (t) {
        t || (this._isPaused = !1), this._interval && (clearInterval(this._interval), this._interval = null), this._config.interval && !this._isPaused && (this._interval = setInterval((document.visibilityState ? this.nextWhenVisible : this.next).bind(this), this._config.interval));
      }, t.to = function (t) {
        var e = this;
        this._activeElement = this._element.querySelector(tt);
        var n = this._getItemIndex(this._activeElement);
        if (!(t > this._items.length - 1 || t < 0)) if (this._isSliding) g(this._element).one(Q.SLID, function () {
          return e.to(t);
        });else {
          if (n === t) return this.pause(), void this.cycle();
          var i = n < t ? W : q;
          this._slide(i, this._items[t]);
        }
      }, t.dispose = function () {
        g(this._element).off(H), g.removeData(this._element, j), this._items = null, this._config = null, this._element = null, this._interval = null, this._isPaused = null, this._isSliding = null, this._activeElement = null, this._indicatorsElement = null;
      }, t._getConfig = function (t) {
        return t = l({}, F, t), _.typeCheckConfig(L, t, U), t;
      }, t._handleSwipe = function () {
        var t = Math.abs(this.touchDeltaX);
        if (!(t <= 40)) {
          var e = t / this.touchDeltaX;
          0 < e && this.prev(), e < 0 && this.next();
        }
      }, t._addEventListeners = function () {
        var e = this;
        this._config.keyboard && g(this._element).on(Q.KEYDOWN, function (t) {
          return e._keydown(t);
        }), "hover" === this._config.pause && g(this._element).on(Q.MOUSEENTER, function (t) {
          return e.pause(t);
        }).on(Q.MOUSELEAVE, function (t) {
          return e.cycle(t);
        }), this._config.touch && this._addTouchEventListeners();
      }, t._addTouchEventListeners = function () {
        var n = this;
        if (this._touchSupported) {
          var e = function e(t) {
              n._pointerEvent && at[t.originalEvent.pointerType.toUpperCase()] ? n.touchStartX = t.originalEvent.clientX : n._pointerEvent || (n.touchStartX = t.originalEvent.touches[0].clientX);
            },
            i = function i(t) {
              n._pointerEvent && at[t.originalEvent.pointerType.toUpperCase()] && (n.touchDeltaX = t.originalEvent.clientX - n.touchStartX), n._handleSwipe(), "hover" === n._config.pause && (n.pause(), n.touchTimeout && clearTimeout(n.touchTimeout), n.touchTimeout = setTimeout(function (t) {
                return n.cycle(t);
              }, 500 + n._config.interval));
            };
          g(this._element.querySelectorAll(nt)).on(Q.DRAG_START, function (t) {
            return t.preventDefault();
          }), this._pointerEvent ? (g(this._element).on(Q.POINTERDOWN, function (t) {
            return e(t);
          }), g(this._element).on(Q.POINTERUP, function (t) {
            return i(t);
          }), this._element.classList.add(J)) : (g(this._element).on(Q.TOUCHSTART, function (t) {
            return e(t);
          }), g(this._element).on(Q.TOUCHMOVE, function (t) {
            var e;
            (e = t).originalEvent.touches && 1 < e.originalEvent.touches.length ? n.touchDeltaX = 0 : n.touchDeltaX = e.originalEvent.touches[0].clientX - n.touchStartX;
          }), g(this._element).on(Q.TOUCHEND, function (t) {
            return i(t);
          }));
        }
      }, t._keydown = function (t) {
        if (!/input|textarea/i.test(t.target.tagName)) switch (t.which) {
          case 37:
            t.preventDefault(), this.prev();
            break;
          case 39:
            t.preventDefault(), this.next();
        }
      }, t._getItemIndex = function (t) {
        return this._items = t && t.parentNode ? [].slice.call(t.parentNode.querySelectorAll(et)) : [], this._items.indexOf(t);
      }, t._getItemByDirection = function (t, e) {
        var n = t === W,
          i = t === q,
          o = this._getItemIndex(e),
          r = this._items.length - 1;
        if ((i && 0 === o || n && o === r) && !this._config.wrap) return e;
        var s = (o + (t === q ? -1 : 1)) % this._items.length;
        return -1 === s ? this._items[this._items.length - 1] : this._items[s];
      }, t._triggerSlideEvent = function (t, e) {
        var n = this._getItemIndex(t),
          i = this._getItemIndex(this._element.querySelector(tt)),
          o = g.Event(Q.SLIDE, {
            relatedTarget: t,
            direction: e,
            from: i,
            to: n
          });
        return g(this._element).trigger(o), o;
      }, t._setActiveIndicatorElement = function (t) {
        if (this._indicatorsElement) {
          var e = [].slice.call(this._indicatorsElement.querySelectorAll(Z));
          g(e).removeClass(V);
          var n = this._indicatorsElement.children[this._getItemIndex(t)];
          n && g(n).addClass(V);
        }
      }, t._slide = function (t, e) {
        var n,
          i,
          o,
          r = this,
          s = this._element.querySelector(tt),
          a = this._getItemIndex(s),
          l = e || s && this._getItemByDirection(t, s),
          c = this._getItemIndex(l),
          h = Boolean(this._interval);
        if (o = t === W ? (n = X, i = $, M) : (n = z, i = G, K), l && g(l).hasClass(V)) this._isSliding = !1;else if (!this._triggerSlideEvent(l, o).isDefaultPrevented() && s && l) {
          this._isSliding = !0, h && this.pause(), this._setActiveIndicatorElement(l);
          var u = g.Event(Q.SLID, {
            relatedTarget: l,
            direction: o,
            from: a,
            to: c
          });
          if (g(this._element).hasClass(Y)) {
            g(l).addClass(i), _.reflow(l), g(s).addClass(n), g(l).addClass(n);
            var f = parseInt(l.getAttribute("data-interval"), 10);
            this._config.interval = f ? (this._config.defaultInterval = this._config.defaultInterval || this._config.interval, f) : this._config.defaultInterval || this._config.interval;
            var d = _.getTransitionDurationFromElement(s);
            g(s).one(_.TRANSITION_END, function () {
              g(l).removeClass(n + " " + i).addClass(V), g(s).removeClass(V + " " + i + " " + n), r._isSliding = !1, setTimeout(function () {
                return g(r._element).trigger(u);
              }, 0);
            }).emulateTransitionEnd(d);
          } else g(s).removeClass(V), g(l).addClass(V), this._isSliding = !1, g(this._element).trigger(u);
          h && this.cycle();
        }
      }, r._jQueryInterface = function (i) {
        return this.each(function () {
          var t = g(this).data(j),
            e = l({}, F, g(this).data());
          "object" == _typeof(i) && (e = l({}, e, i));
          var n = "string" == typeof i ? i : e.slide;
          if (t || (t = new r(this, e), g(this).data(j, t)), "number" == typeof i) t.to(i);else if ("string" == typeof n) {
            if ("undefined" == typeof t[n]) throw new TypeError('No method named "' + n + '"');
            t[n]();
          } else e.interval && e.ride && (t.pause(), t.cycle());
        });
      }, r._dataApiClickHandler = function (t) {
        var e = _.getSelectorFromElement(this);
        if (e) {
          var n = g(e)[0];
          if (n && g(n).hasClass(B)) {
            var i = l({}, g(n).data(), g(this).data()),
              o = this.getAttribute("data-slide-to");
            o && (i.interval = !1), r._jQueryInterface.call(g(n), i), o && g(n).data(j).to(o), t.preventDefault();
          }
        }
      }, s(r, null, [{
        key: "VERSION",
        get: function get() {
          return "4.3.1";
        }
      }, {
        key: "Default",
        get: function get() {
          return F;
        }
      }]), r;
    }();
  g(document).on(Q.CLICK_DATA_API, rt, lt._dataApiClickHandler), g(window).on(Q.LOAD_DATA_API, function () {
    for (var t = [].slice.call(document.querySelectorAll(st)), e = 0, n = t.length; e < n; e++) {
      var i = g(t[e]);
      lt._jQueryInterface.call(i, i.data());
    }
  }), g.fn[L] = lt._jQueryInterface, g.fn[L].Constructor = lt, g.fn[L].noConflict = function () {
    return g.fn[L] = x, lt._jQueryInterface;
  };
  var ct = "collapse",
    ht = "bs.collapse",
    ut = "." + ht,
    ft = g.fn[ct],
    dt = {
      toggle: !0,
      parent: ""
    },
    gt = {
      toggle: "boolean",
      parent: "(string|element)"
    },
    _t = {
      SHOW: "show" + ut,
      SHOWN: "shown" + ut,
      HIDE: "hide" + ut,
      HIDDEN: "hidden" + ut,
      CLICK_DATA_API: "click" + ut + ".data-api"
    },
    mt = "show",
    pt = "collapse",
    vt = "collapsing",
    yt = "collapsed",
    Et = "width",
    Ct = "height",
    Tt = ".show, .collapsing",
    St = '[data-toggle="collapse"]',
    bt = function () {
      function a(e, t) {
        this._isTransitioning = !1, this._element = e, this._config = this._getConfig(t), this._triggerArray = [].slice.call(document.querySelectorAll('[data-toggle="collapse"][href="#' + e.id + '"],[data-toggle="collapse"][data-target="#' + e.id + '"]'));
        for (var n = [].slice.call(document.querySelectorAll(St)), i = 0, o = n.length; i < o; i++) {
          var r = n[i],
            s = _.getSelectorFromElement(r),
            a = [].slice.call(document.querySelectorAll(s)).filter(function (t) {
              return t === e;
            });
          null !== s && 0 < a.length && (this._selector = s, this._triggerArray.push(r));
        }
        this._parent = this._config.parent ? this._getParent() : null, this._config.parent || this._addAriaAndCollapsedClass(this._element, this._triggerArray), this._config.toggle && this.toggle();
      }
      var t = a.prototype;
      return t.toggle = function () {
        g(this._element).hasClass(mt) ? this.hide() : this.show();
      }, t.show = function () {
        var t,
          e,
          n = this;
        if (!this._isTransitioning && !g(this._element).hasClass(mt) && (this._parent && 0 === (t = [].slice.call(this._parent.querySelectorAll(Tt)).filter(function (t) {
          return "string" == typeof n._config.parent ? t.getAttribute("data-parent") === n._config.parent : t.classList.contains(pt);
        })).length && (t = null), !(t && (e = g(t).not(this._selector).data(ht)) && e._isTransitioning))) {
          var i = g.Event(_t.SHOW);
          if (g(this._element).trigger(i), !i.isDefaultPrevented()) {
            t && (a._jQueryInterface.call(g(t).not(this._selector), "hide"), e || g(t).data(ht, null));
            var o = this._getDimension();
            g(this._element).removeClass(pt).addClass(vt), this._element.style[o] = 0, this._triggerArray.length && g(this._triggerArray).removeClass(yt).attr("aria-expanded", !0), this.setTransitioning(!0);
            var r = "scroll" + (o[0].toUpperCase() + o.slice(1)),
              s = _.getTransitionDurationFromElement(this._element);
            g(this._element).one(_.TRANSITION_END, function () {
              g(n._element).removeClass(vt).addClass(pt).addClass(mt), n._element.style[o] = "", n.setTransitioning(!1), g(n._element).trigger(_t.SHOWN);
            }).emulateTransitionEnd(s), this._element.style[o] = this._element[r] + "px";
          }
        }
      }, t.hide = function () {
        var t = this;
        if (!this._isTransitioning && g(this._element).hasClass(mt)) {
          var e = g.Event(_t.HIDE);
          if (g(this._element).trigger(e), !e.isDefaultPrevented()) {
            var n = this._getDimension();
            this._element.style[n] = this._element.getBoundingClientRect()[n] + "px", _.reflow(this._element), g(this._element).addClass(vt).removeClass(pt).removeClass(mt);
            var i = this._triggerArray.length;
            if (0 < i) for (var o = 0; o < i; o++) {
              var r = this._triggerArray[o],
                s = _.getSelectorFromElement(r);
              if (null !== s) g([].slice.call(document.querySelectorAll(s))).hasClass(mt) || g(r).addClass(yt).attr("aria-expanded", !1);
            }
            this.setTransitioning(!0);
            this._element.style[n] = "";
            var a = _.getTransitionDurationFromElement(this._element);
            g(this._element).one(_.TRANSITION_END, function () {
              t.setTransitioning(!1), g(t._element).removeClass(vt).addClass(pt).trigger(_t.HIDDEN);
            }).emulateTransitionEnd(a);
          }
        }
      }, t.setTransitioning = function (t) {
        this._isTransitioning = t;
      }, t.dispose = function () {
        g.removeData(this._element, ht), this._config = null, this._parent = null, this._element = null, this._triggerArray = null, this._isTransitioning = null;
      }, t._getConfig = function (t) {
        return (t = l({}, dt, t)).toggle = Boolean(t.toggle), _.typeCheckConfig(ct, t, gt), t;
      }, t._getDimension = function () {
        return g(this._element).hasClass(Et) ? Et : Ct;
      }, t._getParent = function () {
        var t,
          n = this;
        _.isElement(this._config.parent) ? (t = this._config.parent, "undefined" != typeof this._config.parent.jquery && (t = this._config.parent[0])) : t = document.querySelector(this._config.parent);
        var e = '[data-toggle="collapse"][data-parent="' + this._config.parent + '"]',
          i = [].slice.call(t.querySelectorAll(e));
        return g(i).each(function (t, e) {
          n._addAriaAndCollapsedClass(a._getTargetFromElement(e), [e]);
        }), t;
      }, t._addAriaAndCollapsedClass = function (t, e) {
        var n = g(t).hasClass(mt);
        e.length && g(e).toggleClass(yt, !n).attr("aria-expanded", n);
      }, a._getTargetFromElement = function (t) {
        var e = _.getSelectorFromElement(t);
        return e ? document.querySelector(e) : null;
      }, a._jQueryInterface = function (i) {
        return this.each(function () {
          var t = g(this),
            e = t.data(ht),
            n = l({}, dt, t.data(), "object" == _typeof(i) && i ? i : {});
          if (!e && n.toggle && /show|hide/.test(i) && (n.toggle = !1), e || (e = new a(this, n), t.data(ht, e)), "string" == typeof i) {
            if ("undefined" == typeof e[i]) throw new TypeError('No method named "' + i + '"');
            e[i]();
          }
        });
      }, s(a, null, [{
        key: "VERSION",
        get: function get() {
          return "4.3.1";
        }
      }, {
        key: "Default",
        get: function get() {
          return dt;
        }
      }]), a;
    }();
  g(document).on(_t.CLICK_DATA_API, St, function (t) {
    "A" === t.currentTarget.tagName && t.preventDefault();
    var n = g(this),
      e = _.getSelectorFromElement(this),
      i = [].slice.call(document.querySelectorAll(e));
    g(i).each(function () {
      var t = g(this),
        e = t.data(ht) ? "toggle" : n.data();
      bt._jQueryInterface.call(t, e);
    });
  }), g.fn[ct] = bt._jQueryInterface, g.fn[ct].Constructor = bt, g.fn[ct].noConflict = function () {
    return g.fn[ct] = ft, bt._jQueryInterface;
  };
  var It = "dropdown",
    Dt = "bs.dropdown",
    wt = "." + Dt,
    At = ".data-api",
    Nt = g.fn[It],
    Ot = new RegExp("38|40|27"),
    kt = {
      HIDE: "hide" + wt,
      HIDDEN: "hidden" + wt,
      SHOW: "show" + wt,
      SHOWN: "shown" + wt,
      CLICK: "click" + wt,
      CLICK_DATA_API: "click" + wt + At,
      KEYDOWN_DATA_API: "keydown" + wt + At,
      KEYUP_DATA_API: "keyup" + wt + At
    },
    Pt = "disabled",
    Lt = "show",
    jt = "dropup",
    Ht = "dropright",
    Rt = "dropleft",
    xt = "dropdown-menu-right",
    Ft = "position-static",
    Ut = '[data-toggle="dropdown"]',
    Wt = ".dropdown form",
    qt = ".dropdown-menu",
    Mt = ".navbar-nav",
    Kt = ".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)",
    Qt = "top-start",
    Bt = "top-end",
    Vt = "bottom-start",
    Yt = "bottom-end",
    zt = "right-start",
    Xt = "left-start",
    $t = {
      offset: 0,
      flip: !0,
      boundary: "scrollParent",
      reference: "toggle",
      display: "dynamic"
    },
    Gt = {
      offset: "(number|string|function)",
      flip: "boolean",
      boundary: "(string|element)",
      reference: "(string|element)",
      display: "string"
    },
    Jt = function () {
      function c(t, e) {
        this._element = t, this._popper = null, this._config = this._getConfig(e), this._menu = this._getMenuElement(), this._inNavbar = this._detectNavbar(), this._addEventListeners();
      }
      var t = c.prototype;
      return t.toggle = function () {
        if (!this._element.disabled && !g(this._element).hasClass(Pt)) {
          var t = c._getParentFromElement(this._element),
            e = g(this._menu).hasClass(Lt);
          if (c._clearMenus(), !e) {
            var n = {
                relatedTarget: this._element
              },
              i = g.Event(kt.SHOW, n);
            if (g(t).trigger(i), !i.isDefaultPrevented()) {
              if (!this._inNavbar) {
                if ("undefined" == typeof u) throw new TypeError("Bootstrap's dropdowns require Popper.js (https://popper.js.org/)");
                var o = this._element;
                "parent" === this._config.reference ? o = t : _.isElement(this._config.reference) && (o = this._config.reference, "undefined" != typeof this._config.reference.jquery && (o = this._config.reference[0])), "scrollParent" !== this._config.boundary && g(t).addClass(Ft), this._popper = new u(o, this._menu, this._getPopperConfig());
              }
              "ontouchstart" in document.documentElement && 0 === g(t).closest(Mt).length && g(document.body).children().on("mouseover", null, g.noop), this._element.focus(), this._element.setAttribute("aria-expanded", !0), g(this._menu).toggleClass(Lt), g(t).toggleClass(Lt).trigger(g.Event(kt.SHOWN, n));
            }
          }
        }
      }, t.show = function () {
        if (!(this._element.disabled || g(this._element).hasClass(Pt) || g(this._menu).hasClass(Lt))) {
          var t = {
              relatedTarget: this._element
            },
            e = g.Event(kt.SHOW, t),
            n = c._getParentFromElement(this._element);
          g(n).trigger(e), e.isDefaultPrevented() || (g(this._menu).toggleClass(Lt), g(n).toggleClass(Lt).trigger(g.Event(kt.SHOWN, t)));
        }
      }, t.hide = function () {
        if (!this._element.disabled && !g(this._element).hasClass(Pt) && g(this._menu).hasClass(Lt)) {
          var t = {
              relatedTarget: this._element
            },
            e = g.Event(kt.HIDE, t),
            n = c._getParentFromElement(this._element);
          g(n).trigger(e), e.isDefaultPrevented() || (g(this._menu).toggleClass(Lt), g(n).toggleClass(Lt).trigger(g.Event(kt.HIDDEN, t)));
        }
      }, t.dispose = function () {
        g.removeData(this._element, Dt), g(this._element).off(wt), this._element = null, (this._menu = null) !== this._popper && (this._popper.destroy(), this._popper = null);
      }, t.update = function () {
        this._inNavbar = this._detectNavbar(), null !== this._popper && this._popper.scheduleUpdate();
      }, t._addEventListeners = function () {
        var e = this;
        g(this._element).on(kt.CLICK, function (t) {
          t.preventDefault(), t.stopPropagation(), e.toggle();
        });
      }, t._getConfig = function (t) {
        return t = l({}, this.constructor.Default, g(this._element).data(), t), _.typeCheckConfig(It, t, this.constructor.DefaultType), t;
      }, t._getMenuElement = function () {
        if (!this._menu) {
          var t = c._getParentFromElement(this._element);
          t && (this._menu = t.querySelector(qt));
        }
        return this._menu;
      }, t._getPlacement = function () {
        var t = g(this._element.parentNode),
          e = Vt;
        return t.hasClass(jt) ? (e = Qt, g(this._menu).hasClass(xt) && (e = Bt)) : t.hasClass(Ht) ? e = zt : t.hasClass(Rt) ? e = Xt : g(this._menu).hasClass(xt) && (e = Yt), e;
      }, t._detectNavbar = function () {
        return 0 < g(this._element).closest(".navbar").length;
      }, t._getOffset = function () {
        var e = this,
          t = {};
        return "function" == typeof this._config.offset ? t.fn = function (t) {
          return t.offsets = l({}, t.offsets, e._config.offset(t.offsets, e._element) || {}), t;
        } : t.offset = this._config.offset, t;
      }, t._getPopperConfig = function () {
        var t = {
          placement: this._getPlacement(),
          modifiers: {
            offset: this._getOffset(),
            flip: {
              enabled: this._config.flip
            },
            preventOverflow: {
              boundariesElement: this._config.boundary
            }
          }
        };
        return "static" === this._config.display && (t.modifiers.applyStyle = {
          enabled: !1
        }), t;
      }, c._jQueryInterface = function (e) {
        return this.each(function () {
          var t = g(this).data(Dt);
          if (t || (t = new c(this, "object" == _typeof(e) ? e : null), g(this).data(Dt, t)), "string" == typeof e) {
            if ("undefined" == typeof t[e]) throw new TypeError('No method named "' + e + '"');
            t[e]();
          }
        });
      }, c._clearMenus = function (t) {
        if (!t || 3 !== t.which && ("keyup" !== t.type || 9 === t.which)) for (var e = [].slice.call(document.querySelectorAll(Ut)), n = 0, i = e.length; n < i; n++) {
          var o = c._getParentFromElement(e[n]),
            r = g(e[n]).data(Dt),
            s = {
              relatedTarget: e[n]
            };
          if (t && "click" === t.type && (s.clickEvent = t), r) {
            var a = r._menu;
            if (g(o).hasClass(Lt) && !(t && ("click" === t.type && /input|textarea/i.test(t.target.tagName) || "keyup" === t.type && 9 === t.which) && g.contains(o, t.target))) {
              var l = g.Event(kt.HIDE, s);
              g(o).trigger(l), l.isDefaultPrevented() || ("ontouchstart" in document.documentElement && g(document.body).children().off("mouseover", null, g.noop), e[n].setAttribute("aria-expanded", "false"), g(a).removeClass(Lt), g(o).removeClass(Lt).trigger(g.Event(kt.HIDDEN, s)));
            }
          }
        }
      }, c._getParentFromElement = function (t) {
        var e,
          n = _.getSelectorFromElement(t);
        return n && (e = document.querySelector(n)), e || t.parentNode;
      }, c._dataApiKeydownHandler = function (t) {
        if ((/input|textarea/i.test(t.target.tagName) ? !(32 === t.which || 27 !== t.which && (40 !== t.which && 38 !== t.which || g(t.target).closest(qt).length)) : Ot.test(t.which)) && (t.preventDefault(), t.stopPropagation(), !this.disabled && !g(this).hasClass(Pt))) {
          var e = c._getParentFromElement(this),
            n = g(e).hasClass(Lt);
          if (n && (!n || 27 !== t.which && 32 !== t.which)) {
            var i = [].slice.call(e.querySelectorAll(Kt));
            if (0 !== i.length) {
              var o = i.indexOf(t.target);
              38 === t.which && 0 < o && o--, 40 === t.which && o < i.length - 1 && o++, o < 0 && (o = 0), i[o].focus();
            }
          } else {
            if (27 === t.which) {
              var r = e.querySelector(Ut);
              g(r).trigger("focus");
            }
            g(this).trigger("click");
          }
        }
      }, s(c, null, [{
        key: "VERSION",
        get: function get() {
          return "4.3.1";
        }
      }, {
        key: "Default",
        get: function get() {
          return $t;
        }
      }, {
        key: "DefaultType",
        get: function get() {
          return Gt;
        }
      }]), c;
    }();
  g(document).on(kt.KEYDOWN_DATA_API, Ut, Jt._dataApiKeydownHandler).on(kt.KEYDOWN_DATA_API, qt, Jt._dataApiKeydownHandler).on(kt.CLICK_DATA_API + " " + kt.KEYUP_DATA_API, Jt._clearMenus).on(kt.CLICK_DATA_API, Ut, function (t) {
    t.preventDefault(), t.stopPropagation(), Jt._jQueryInterface.call(g(this), "toggle");
  }).on(kt.CLICK_DATA_API, Wt, function (t) {
    t.stopPropagation();
  }), g.fn[It] = Jt._jQueryInterface, g.fn[It].Constructor = Jt, g.fn[It].noConflict = function () {
    return g.fn[It] = Nt, Jt._jQueryInterface;
  };
  var Zt = "modal",
    te = "bs.modal",
    ee = "." + te,
    ne = g.fn[Zt],
    ie = {
      backdrop: !0,
      keyboard: !0,
      focus: !0,
      show: !0
    },
    oe = {
      backdrop: "(boolean|string)",
      keyboard: "boolean",
      focus: "boolean",
      show: "boolean"
    },
    re = {
      HIDE: "hide" + ee,
      HIDDEN: "hidden" + ee,
      SHOW: "show" + ee,
      SHOWN: "shown" + ee,
      FOCUSIN: "focusin" + ee,
      RESIZE: "resize" + ee,
      CLICK_DISMISS: "click.dismiss" + ee,
      KEYDOWN_DISMISS: "keydown.dismiss" + ee,
      MOUSEUP_DISMISS: "mouseup.dismiss" + ee,
      MOUSEDOWN_DISMISS: "mousedown.dismiss" + ee,
      CLICK_DATA_API: "click" + ee + ".data-api"
    },
    se = "modal-dialog-scrollable",
    ae = "modal-scrollbar-measure",
    le = "modal-backdrop",
    ce = "modal-open",
    he = "fade",
    ue = "show",
    fe = ".modal-dialog",
    de = ".modal-body",
    ge = '[data-toggle="modal"]',
    _e = '[data-dismiss="modal"]',
    me = ".fixed-top, .fixed-bottom, .is-fixed, .sticky-top",
    pe = ".sticky-top",
    ve = function () {
      function o(t, e) {
        this._config = this._getConfig(e), this._element = t, this._dialog = t.querySelector(fe), this._backdrop = null, this._isShown = !1, this._isBodyOverflowing = !1, this._ignoreBackdropClick = !1, this._isTransitioning = !1, this._scrollbarWidth = 0;
      }
      var t = o.prototype;
      return t.toggle = function (t) {
        return this._isShown ? this.hide() : this.show(t);
      }, t.show = function (t) {
        var e = this;
        if (!this._isShown && !this._isTransitioning) {
          g(this._element).hasClass(he) && (this._isTransitioning = !0);
          var n = g.Event(re.SHOW, {
            relatedTarget: t
          });
          g(this._element).trigger(n), this._isShown || n.isDefaultPrevented() || (this._isShown = !0, this._checkScrollbar(), this._setScrollbar(), this._adjustDialog(), this._setEscapeEvent(), this._setResizeEvent(), g(this._element).on(re.CLICK_DISMISS, _e, function (t) {
            return e.hide(t);
          }), g(this._dialog).on(re.MOUSEDOWN_DISMISS, function () {
            g(e._element).one(re.MOUSEUP_DISMISS, function (t) {
              g(t.target).is(e._element) && (e._ignoreBackdropClick = !0);
            });
          }), this._showBackdrop(function () {
            return e._showElement(t);
          }));
        }
      }, t.hide = function (t) {
        var e = this;
        if (t && t.preventDefault(), this._isShown && !this._isTransitioning) {
          var n = g.Event(re.HIDE);
          if (g(this._element).trigger(n), this._isShown && !n.isDefaultPrevented()) {
            this._isShown = !1;
            var i = g(this._element).hasClass(he);
            if (i && (this._isTransitioning = !0), this._setEscapeEvent(), this._setResizeEvent(), g(document).off(re.FOCUSIN), g(this._element).removeClass(ue), g(this._element).off(re.CLICK_DISMISS), g(this._dialog).off(re.MOUSEDOWN_DISMISS), i) {
              var o = _.getTransitionDurationFromElement(this._element);
              g(this._element).one(_.TRANSITION_END, function (t) {
                return e._hideModal(t);
              }).emulateTransitionEnd(o);
            } else this._hideModal();
          }
        }
      }, t.dispose = function () {
        [window, this._element, this._dialog].forEach(function (t) {
          return g(t).off(ee);
        }), g(document).off(re.FOCUSIN), g.removeData(this._element, te), this._config = null, this._element = null, this._dialog = null, this._backdrop = null, this._isShown = null, this._isBodyOverflowing = null, this._ignoreBackdropClick = null, this._isTransitioning = null, this._scrollbarWidth = null;
      }, t.handleUpdate = function () {
        this._adjustDialog();
      }, t._getConfig = function (t) {
        return t = l({}, ie, t), _.typeCheckConfig(Zt, t, oe), t;
      }, t._showElement = function (t) {
        var e = this,
          n = g(this._element).hasClass(he);
        this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE || document.body.appendChild(this._element), this._element.style.display = "block", this._element.removeAttribute("aria-hidden"), this._element.setAttribute("aria-modal", !0), g(this._dialog).hasClass(se) ? this._dialog.querySelector(de).scrollTop = 0 : this._element.scrollTop = 0, n && _.reflow(this._element), g(this._element).addClass(ue), this._config.focus && this._enforceFocus();
        var i = g.Event(re.SHOWN, {
            relatedTarget: t
          }),
          o = function o() {
            e._config.focus && e._element.focus(), e._isTransitioning = !1, g(e._element).trigger(i);
          };
        if (n) {
          var r = _.getTransitionDurationFromElement(this._dialog);
          g(this._dialog).one(_.TRANSITION_END, o).emulateTransitionEnd(r);
        } else o();
      }, t._enforceFocus = function () {
        var e = this;
        g(document).off(re.FOCUSIN).on(re.FOCUSIN, function (t) {
          document !== t.target && e._element !== t.target && 0 === g(e._element).has(t.target).length && e._element.focus();
        });
      }, t._setEscapeEvent = function () {
        var e = this;
        this._isShown && this._config.keyboard ? g(this._element).on(re.KEYDOWN_DISMISS, function (t) {
          27 === t.which && (t.preventDefault(), e.hide());
        }) : this._isShown || g(this._element).off(re.KEYDOWN_DISMISS);
      }, t._setResizeEvent = function () {
        var e = this;
        this._isShown ? g(window).on(re.RESIZE, function (t) {
          return e.handleUpdate(t);
        }) : g(window).off(re.RESIZE);
      }, t._hideModal = function () {
        var t = this;
        this._element.style.display = "none", this._element.setAttribute("aria-hidden", !0), this._element.removeAttribute("aria-modal"), this._isTransitioning = !1, this._showBackdrop(function () {
          g(document.body).removeClass(ce), t._resetAdjustments(), t._resetScrollbar(), g(t._element).trigger(re.HIDDEN);
        });
      }, t._removeBackdrop = function () {
        this._backdrop && (g(this._backdrop).remove(), this._backdrop = null);
      }, t._showBackdrop = function (t) {
        var e = this,
          n = g(this._element).hasClass(he) ? he : "";
        if (this._isShown && this._config.backdrop) {
          if (this._backdrop = document.createElement("div"), this._backdrop.className = le, n && this._backdrop.classList.add(n), g(this._backdrop).appendTo(document.body), g(this._element).on(re.CLICK_DISMISS, function (t) {
            e._ignoreBackdropClick ? e._ignoreBackdropClick = !1 : t.target === t.currentTarget && ("static" === e._config.backdrop ? e._element.focus() : e.hide());
          }), n && _.reflow(this._backdrop), g(this._backdrop).addClass(ue), !t) return;
          if (!n) return void t();
          var i = _.getTransitionDurationFromElement(this._backdrop);
          g(this._backdrop).one(_.TRANSITION_END, t).emulateTransitionEnd(i);
        } else if (!this._isShown && this._backdrop) {
          g(this._backdrop).removeClass(ue);
          var o = function o() {
            e._removeBackdrop(), t && t();
          };
          if (g(this._element).hasClass(he)) {
            var r = _.getTransitionDurationFromElement(this._backdrop);
            g(this._backdrop).one(_.TRANSITION_END, o).emulateTransitionEnd(r);
          } else o();
        } else t && t();
      }, t._adjustDialog = function () {
        var t = this._element.scrollHeight > document.documentElement.clientHeight;
        !this._isBodyOverflowing && t && (this._element.style.paddingLeft = this._scrollbarWidth + "px"), this._isBodyOverflowing && !t && (this._element.style.paddingRight = this._scrollbarWidth + "px");
      }, t._resetAdjustments = function () {
        this._element.style.paddingLeft = "", this._element.style.paddingRight = "";
      }, t._checkScrollbar = function () {
        var t = document.body.getBoundingClientRect();
        this._isBodyOverflowing = t.left + t.right < window.innerWidth, this._scrollbarWidth = this._getScrollbarWidth();
      }, t._setScrollbar = function () {
        var o = this;
        if (this._isBodyOverflowing) {
          var t = [].slice.call(document.querySelectorAll(me)),
            e = [].slice.call(document.querySelectorAll(pe));
          g(t).each(function (t, e) {
            var n = e.style.paddingRight,
              i = g(e).css("padding-right");
            g(e).data("padding-right", n).css("padding-right", parseFloat(i) + o._scrollbarWidth + "px");
          }), g(e).each(function (t, e) {
            var n = e.style.marginRight,
              i = g(e).css("margin-right");
            g(e).data("margin-right", n).css("margin-right", parseFloat(i) - o._scrollbarWidth + "px");
          });
          var n = document.body.style.paddingRight,
            i = g(document.body).css("padding-right");
          g(document.body).data("padding-right", n).css("padding-right", parseFloat(i) + this._scrollbarWidth + "px");
        }
        g(document.body).addClass(ce);
      }, t._resetScrollbar = function () {
        var t = [].slice.call(document.querySelectorAll(me));
        g(t).each(function (t, e) {
          var n = g(e).data("padding-right");
          g(e).removeData("padding-right"), e.style.paddingRight = n || "";
        });
        var e = [].slice.call(document.querySelectorAll("" + pe));
        g(e).each(function (t, e) {
          var n = g(e).data("margin-right");
          "undefined" != typeof n && g(e).css("margin-right", n).removeData("margin-right");
        });
        var n = g(document.body).data("padding-right");
        g(document.body).removeData("padding-right"), document.body.style.paddingRight = n || "";
      }, t._getScrollbarWidth = function () {
        var t = document.createElement("div");
        t.className = ae, document.body.appendChild(t);
        var e = t.getBoundingClientRect().width - t.clientWidth;
        return document.body.removeChild(t), e;
      }, o._jQueryInterface = function (n, i) {
        return this.each(function () {
          var t = g(this).data(te),
            e = l({}, ie, g(this).data(), "object" == _typeof(n) && n ? n : {});
          if (t || (t = new o(this, e), g(this).data(te, t)), "string" == typeof n) {
            if ("undefined" == typeof t[n]) throw new TypeError('No method named "' + n + '"');
            t[n](i);
          } else e.show && t.show(i);
        });
      }, s(o, null, [{
        key: "VERSION",
        get: function get() {
          return "4.3.1";
        }
      }, {
        key: "Default",
        get: function get() {
          return ie;
        }
      }]), o;
    }();
  g(document).on(re.CLICK_DATA_API, ge, function (t) {
    var e,
      n = this,
      i = _.getSelectorFromElement(this);
    i && (e = document.querySelector(i));
    var o = g(e).data(te) ? "toggle" : l({}, g(e).data(), g(this).data());
    "A" !== this.tagName && "AREA" !== this.tagName || t.preventDefault();
    var r = g(e).one(re.SHOW, function (t) {
      t.isDefaultPrevented() || r.one(re.HIDDEN, function () {
        g(n).is(":visible") && n.focus();
      });
    });
    ve._jQueryInterface.call(g(e), o, this);
  }), g.fn[Zt] = ve._jQueryInterface, g.fn[Zt].Constructor = ve, g.fn[Zt].noConflict = function () {
    return g.fn[Zt] = ne, ve._jQueryInterface;
  };
  var ye = ["background", "cite", "href", "itemtype", "longdesc", "poster", "src", "xlink:href"],
    Ee = {
      "*": ["class", "dir", "id", "lang", "role", /^aria-[\w-]*$/i],
      a: ["target", "href", "title", "rel"],
      area: [],
      b: [],
      br: [],
      col: [],
      code: [],
      div: [],
      em: [],
      hr: [],
      h1: [],
      h2: [],
      h3: [],
      h4: [],
      h5: [],
      h6: [],
      i: [],
      img: ["src", "alt", "title", "width", "height"],
      li: [],
      ol: [],
      p: [],
      pre: [],
      s: [],
      small: [],
      span: [],
      sub: [],
      sup: [],
      strong: [],
      u: [],
      ul: []
    },
    Ce = /^(?:(?:https?|mailto|ftp|tel|file):|[^&:/?#]*(?:[/?#]|$))/gi,
    Te = /^data:(?:image\/(?:bmp|gif|jpeg|jpg|png|tiff|webp)|video\/(?:mpeg|mp4|ogg|webm)|audio\/(?:mp3|oga|ogg|opus));base64,[a-z0-9+/]+=*$/i;
  function Se(t, s, e) {
    if (0 === t.length) return t;
    if (e && "function" == typeof e) return e(t);
    for (var n = new window.DOMParser().parseFromString(t, "text/html"), a = Object.keys(s), l = [].slice.call(n.body.querySelectorAll("*")), i = function i(t, e) {
        var n = l[t],
          i = n.nodeName.toLowerCase();
        if (-1 === a.indexOf(n.nodeName.toLowerCase())) return n.parentNode.removeChild(n), "continue";
        var o = [].slice.call(n.attributes),
          r = [].concat(s["*"] || [], s[i] || []);
        o.forEach(function (t) {
          (function (t, e) {
            var n = t.nodeName.toLowerCase();
            if (-1 !== e.indexOf(n)) return -1 === ye.indexOf(n) || Boolean(t.nodeValue.match(Ce) || t.nodeValue.match(Te));
            for (var i = e.filter(function (t) {
                return t instanceof RegExp;
              }), o = 0, r = i.length; o < r; o++) if (n.match(i[o])) return !0;
            return !1;
          })(t, r) || n.removeAttribute(t.nodeName);
        });
      }, o = 0, r = l.length; o < r; o++) i(o);
    return n.body.innerHTML;
  }
  var be = "tooltip",
    Ie = "bs.tooltip",
    De = "." + Ie,
    we = g.fn[be],
    Ae = "bs-tooltip",
    Ne = new RegExp("(^|\\s)" + Ae + "\\S+", "g"),
    Oe = ["sanitize", "whiteList", "sanitizeFn"],
    ke = {
      animation: "boolean",
      template: "string",
      title: "(string|element|function)",
      trigger: "string",
      delay: "(number|object)",
      html: "boolean",
      selector: "(string|boolean)",
      placement: "(string|function)",
      offset: "(number|string|function)",
      container: "(string|element|boolean)",
      fallbackPlacement: "(string|array)",
      boundary: "(string|element)",
      sanitize: "boolean",
      sanitizeFn: "(null|function)",
      whiteList: "object"
    },
    Pe = {
      AUTO: "auto",
      TOP: "top",
      RIGHT: "right",
      BOTTOM: "bottom",
      LEFT: "left"
    },
    Le = {
      animation: !0,
      template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
      trigger: "hover focus",
      title: "",
      delay: 0,
      html: !1,
      selector: !1,
      placement: "top",
      offset: 0,
      container: !1,
      fallbackPlacement: "flip",
      boundary: "scrollParent",
      sanitize: !0,
      sanitizeFn: null,
      whiteList: Ee
    },
    je = "show",
    He = "out",
    Re = {
      HIDE: "hide" + De,
      HIDDEN: "hidden" + De,
      SHOW: "show" + De,
      SHOWN: "shown" + De,
      INSERTED: "inserted" + De,
      CLICK: "click" + De,
      FOCUSIN: "focusin" + De,
      FOCUSOUT: "focusout" + De,
      MOUSEENTER: "mouseenter" + De,
      MOUSELEAVE: "mouseleave" + De
    },
    xe = "fade",
    Fe = "show",
    Ue = ".tooltip-inner",
    We = ".arrow",
    qe = "hover",
    Me = "focus",
    Ke = "click",
    Qe = "manual",
    Be = function () {
      function i(t, e) {
        if ("undefined" == typeof u) throw new TypeError("Bootstrap's tooltips require Popper.js (https://popper.js.org/)");
        this._isEnabled = !0, this._timeout = 0, this._hoverState = "", this._activeTrigger = {}, this._popper = null, this.element = t, this.config = this._getConfig(e), this.tip = null, this._setListeners();
      }
      var t = i.prototype;
      return t.enable = function () {
        this._isEnabled = !0;
      }, t.disable = function () {
        this._isEnabled = !1;
      }, t.toggleEnabled = function () {
        this._isEnabled = !this._isEnabled;
      }, t.toggle = function (t) {
        if (this._isEnabled) if (t) {
          var e = this.constructor.DATA_KEY,
            n = g(t.currentTarget).data(e);
          n || (n = new this.constructor(t.currentTarget, this._getDelegateConfig()), g(t.currentTarget).data(e, n)), n._activeTrigger.click = !n._activeTrigger.click, n._isWithActiveTrigger() ? n._enter(null, n) : n._leave(null, n);
        } else {
          if (g(this.getTipElement()).hasClass(Fe)) return void this._leave(null, this);
          this._enter(null, this);
        }
      }, t.dispose = function () {
        clearTimeout(this._timeout), g.removeData(this.element, this.constructor.DATA_KEY), g(this.element).off(this.constructor.EVENT_KEY), g(this.element).closest(".modal").off("hide.bs.modal"), this.tip && g(this.tip).remove(), this._isEnabled = null, this._timeout = null, this._hoverState = null, (this._activeTrigger = null) !== this._popper && this._popper.destroy(), this._popper = null, this.element = null, this.config = null, this.tip = null;
      }, t.show = function () {
        var e = this;
        if ("none" === g(this.element).css("display")) throw new Error("Please use show on visible elements");
        var t = g.Event(this.constructor.Event.SHOW);
        if (this.isWithContent() && this._isEnabled) {
          g(this.element).trigger(t);
          var n = _.findShadowRoot(this.element),
            i = g.contains(null !== n ? n : this.element.ownerDocument.documentElement, this.element);
          if (t.isDefaultPrevented() || !i) return;
          var o = this.getTipElement(),
            r = _.getUID(this.constructor.NAME);
          o.setAttribute("id", r), this.element.setAttribute("aria-describedby", r), this.setContent(), this.config.animation && g(o).addClass(xe);
          var s = "function" == typeof this.config.placement ? this.config.placement.call(this, o, this.element) : this.config.placement,
            a = this._getAttachment(s);
          this.addAttachmentClass(a);
          var l = this._getContainer();
          g(o).data(this.constructor.DATA_KEY, this), g.contains(this.element.ownerDocument.documentElement, this.tip) || g(o).appendTo(l), g(this.element).trigger(this.constructor.Event.INSERTED), this._popper = new u(this.element, o, {
            placement: a,
            modifiers: {
              offset: this._getOffset(),
              flip: {
                behavior: this.config.fallbackPlacement
              },
              arrow: {
                element: We
              },
              preventOverflow: {
                boundariesElement: this.config.boundary
              }
            },
            onCreate: function onCreate(t) {
              t.originalPlacement !== t.placement && e._handlePopperPlacementChange(t);
            },
            onUpdate: function onUpdate(t) {
              return e._handlePopperPlacementChange(t);
            }
          }), g(o).addClass(Fe), "ontouchstart" in document.documentElement && g(document.body).children().on("mouseover", null, g.noop);
          var c = function c() {
            e.config.animation && e._fixTransition();
            var t = e._hoverState;
            e._hoverState = null, g(e.element).trigger(e.constructor.Event.SHOWN), t === He && e._leave(null, e);
          };
          if (g(this.tip).hasClass(xe)) {
            var h = _.getTransitionDurationFromElement(this.tip);
            g(this.tip).one(_.TRANSITION_END, c).emulateTransitionEnd(h);
          } else c();
        }
      }, t.hide = function (t) {
        var e = this,
          n = this.getTipElement(),
          i = g.Event(this.constructor.Event.HIDE),
          o = function o() {
            e._hoverState !== je && n.parentNode && n.parentNode.removeChild(n), e._cleanTipClass(), e.element.removeAttribute("aria-describedby"), g(e.element).trigger(e.constructor.Event.HIDDEN), null !== e._popper && e._popper.destroy(), t && t();
          };
        if (g(this.element).trigger(i), !i.isDefaultPrevented()) {
          if (g(n).removeClass(Fe), "ontouchstart" in document.documentElement && g(document.body).children().off("mouseover", null, g.noop), this._activeTrigger[Ke] = !1, this._activeTrigger[Me] = !1, this._activeTrigger[qe] = !1, g(this.tip).hasClass(xe)) {
            var r = _.getTransitionDurationFromElement(n);
            g(n).one(_.TRANSITION_END, o).emulateTransitionEnd(r);
          } else o();
          this._hoverState = "";
        }
      }, t.update = function () {
        null !== this._popper && this._popper.scheduleUpdate();
      }, t.isWithContent = function () {
        return Boolean(this.getTitle());
      }, t.addAttachmentClass = function (t) {
        g(this.getTipElement()).addClass(Ae + "-" + t);
      }, t.getTipElement = function () {
        return this.tip = this.tip || g(this.config.template)[0], this.tip;
      }, t.setContent = function () {
        var t = this.getTipElement();
        this.setElementContent(g(t.querySelectorAll(Ue)), this.getTitle()), g(t).removeClass(xe + " " + Fe);
      }, t.setElementContent = function (t, e) {
        "object" != _typeof(e) || !e.nodeType && !e.jquery ? this.config.html ? (this.config.sanitize && (e = Se(e, this.config.whiteList, this.config.sanitizeFn)), t.html(e)) : t.text(e) : this.config.html ? g(e).parent().is(t) || t.empty().append(e) : t.text(g(e).text());
      }, t.getTitle = function () {
        var t = this.element.getAttribute("data-original-title");
        return t || (t = "function" == typeof this.config.title ? this.config.title.call(this.element) : this.config.title), t;
      }, t._getOffset = function () {
        var e = this,
          t = {};
        return "function" == typeof this.config.offset ? t.fn = function (t) {
          return t.offsets = l({}, t.offsets, e.config.offset(t.offsets, e.element) || {}), t;
        } : t.offset = this.config.offset, t;
      }, t._getContainer = function () {
        return !1 === this.config.container ? document.body : _.isElement(this.config.container) ? g(this.config.container) : g(document).find(this.config.container);
      }, t._getAttachment = function (t) {
        return Pe[t.toUpperCase()];
      }, t._setListeners = function () {
        var i = this;
        this.config.trigger.split(" ").forEach(function (t) {
          if ("click" === t) g(i.element).on(i.constructor.Event.CLICK, i.config.selector, function (t) {
            return i.toggle(t);
          });else if (t !== Qe) {
            var e = t === qe ? i.constructor.Event.MOUSEENTER : i.constructor.Event.FOCUSIN,
              n = t === qe ? i.constructor.Event.MOUSELEAVE : i.constructor.Event.FOCUSOUT;
            g(i.element).on(e, i.config.selector, function (t) {
              return i._enter(t);
            }).on(n, i.config.selector, function (t) {
              return i._leave(t);
            });
          }
        }), g(this.element).closest(".modal").on("hide.bs.modal", function () {
          i.element && i.hide();
        }), this.config.selector ? this.config = l({}, this.config, {
          trigger: "manual",
          selector: ""
        }) : this._fixTitle();
      }, t._fixTitle = function () {
        var t = _typeof(this.element.getAttribute("data-original-title"));
        (this.element.getAttribute("title") || "string" !== t) && (this.element.setAttribute("data-original-title", this.element.getAttribute("title") || ""), this.element.setAttribute("title", ""));
      }, t._enter = function (t, e) {
        var n = this.constructor.DATA_KEY;
        (e = e || g(t.currentTarget).data(n)) || (e = new this.constructor(t.currentTarget, this._getDelegateConfig()), g(t.currentTarget).data(n, e)), t && (e._activeTrigger["focusin" === t.type ? Me : qe] = !0), g(e.getTipElement()).hasClass(Fe) || e._hoverState === je ? e._hoverState = je : (clearTimeout(e._timeout), e._hoverState = je, e.config.delay && e.config.delay.show ? e._timeout = setTimeout(function () {
          e._hoverState === je && e.show();
        }, e.config.delay.show) : e.show());
      }, t._leave = function (t, e) {
        var n = this.constructor.DATA_KEY;
        (e = e || g(t.currentTarget).data(n)) || (e = new this.constructor(t.currentTarget, this._getDelegateConfig()), g(t.currentTarget).data(n, e)), t && (e._activeTrigger["focusout" === t.type ? Me : qe] = !1), e._isWithActiveTrigger() || (clearTimeout(e._timeout), e._hoverState = He, e.config.delay && e.config.delay.hide ? e._timeout = setTimeout(function () {
          e._hoverState === He && e.hide();
        }, e.config.delay.hide) : e.hide());
      }, t._isWithActiveTrigger = function () {
        for (var t in this._activeTrigger) if (this._activeTrigger[t]) return !0;
        return !1;
      }, t._getConfig = function (t) {
        var e = g(this.element).data();
        return Object.keys(e).forEach(function (t) {
          -1 !== Oe.indexOf(t) && delete e[t];
        }), "number" == typeof (t = l({}, this.constructor.Default, e, "object" == _typeof(t) && t ? t : {})).delay && (t.delay = {
          show: t.delay,
          hide: t.delay
        }), "number" == typeof t.title && (t.title = t.title.toString()), "number" == typeof t.content && (t.content = t.content.toString()), _.typeCheckConfig(be, t, this.constructor.DefaultType), t.sanitize && (t.template = Se(t.template, t.whiteList, t.sanitizeFn)), t;
      }, t._getDelegateConfig = function () {
        var t = {};
        if (this.config) for (var e in this.config) this.constructor.Default[e] !== this.config[e] && (t[e] = this.config[e]);
        return t;
      }, t._cleanTipClass = function () {
        var t = g(this.getTipElement()),
          e = t.attr("class").match(Ne);
        null !== e && e.length && t.removeClass(e.join(""));
      }, t._handlePopperPlacementChange = function (t) {
        var e = t.instance;
        this.tip = e.popper, this._cleanTipClass(), this.addAttachmentClass(this._getAttachment(t.placement));
      }, t._fixTransition = function () {
        var t = this.getTipElement(),
          e = this.config.animation;
        null === t.getAttribute("x-placement") && (g(t).removeClass(xe), this.config.animation = !1, this.hide(), this.show(), this.config.animation = e);
      }, i._jQueryInterface = function (n) {
        return this.each(function () {
          var t = g(this).data(Ie),
            e = "object" == _typeof(n) && n;
          if ((t || !/dispose|hide/.test(n)) && (t || (t = new i(this, e), g(this).data(Ie, t)), "string" == typeof n)) {
            if ("undefined" == typeof t[n]) throw new TypeError('No method named "' + n + '"');
            t[n]();
          }
        });
      }, s(i, null, [{
        key: "VERSION",
        get: function get() {
          return "4.3.1";
        }
      }, {
        key: "Default",
        get: function get() {
          return Le;
        }
      }, {
        key: "NAME",
        get: function get() {
          return be;
        }
      }, {
        key: "DATA_KEY",
        get: function get() {
          return Ie;
        }
      }, {
        key: "Event",
        get: function get() {
          return Re;
        }
      }, {
        key: "EVENT_KEY",
        get: function get() {
          return De;
        }
      }, {
        key: "DefaultType",
        get: function get() {
          return ke;
        }
      }]), i;
    }();
  g.fn[be] = Be._jQueryInterface, g.fn[be].Constructor = Be, g.fn[be].noConflict = function () {
    return g.fn[be] = we, Be._jQueryInterface;
  };
  var Ve = "popover",
    Ye = "bs.popover",
    ze = "." + Ye,
    Xe = g.fn[Ve],
    $e = "bs-popover",
    Ge = new RegExp("(^|\\s)" + $e + "\\S+", "g"),
    Je = l({}, Be.Default, {
      placement: "right",
      trigger: "click",
      content: "",
      template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
    }),
    Ze = l({}, Be.DefaultType, {
      content: "(string|element|function)"
    }),
    tn = "fade",
    en = "show",
    nn = ".popover-header",
    on = ".popover-body",
    rn = {
      HIDE: "hide" + ze,
      HIDDEN: "hidden" + ze,
      SHOW: "show" + ze,
      SHOWN: "shown" + ze,
      INSERTED: "inserted" + ze,
      CLICK: "click" + ze,
      FOCUSIN: "focusin" + ze,
      FOCUSOUT: "focusout" + ze,
      MOUSEENTER: "mouseenter" + ze,
      MOUSELEAVE: "mouseleave" + ze
    },
    sn = function (t) {
      var e, n;
      function i() {
        return t.apply(this, arguments) || this;
      }
      n = t, (e = i).prototype = Object.create(n.prototype), (e.prototype.constructor = e).__proto__ = n;
      var o = i.prototype;
      return o.isWithContent = function () {
        return this.getTitle() || this._getContent();
      }, o.addAttachmentClass = function (t) {
        g(this.getTipElement()).addClass($e + "-" + t);
      }, o.getTipElement = function () {
        return this.tip = this.tip || g(this.config.template)[0], this.tip;
      }, o.setContent = function () {
        var t = g(this.getTipElement());
        this.setElementContent(t.find(nn), this.getTitle());
        var e = this._getContent();
        "function" == typeof e && (e = e.call(this.element)), this.setElementContent(t.find(on), e), t.removeClass(tn + " " + en);
      }, o._getContent = function () {
        return this.element.getAttribute("data-content") || this.config.content;
      }, o._cleanTipClass = function () {
        var t = g(this.getTipElement()),
          e = t.attr("class").match(Ge);
        null !== e && 0 < e.length && t.removeClass(e.join(""));
      }, i._jQueryInterface = function (n) {
        return this.each(function () {
          var t = g(this).data(Ye),
            e = "object" == _typeof(n) ? n : null;
          if ((t || !/dispose|hide/.test(n)) && (t || (t = new i(this, e), g(this).data(Ye, t)), "string" == typeof n)) {
            if ("undefined" == typeof t[n]) throw new TypeError('No method named "' + n + '"');
            t[n]();
          }
        });
      }, s(i, null, [{
        key: "VERSION",
        get: function get() {
          return "4.3.1";
        }
      }, {
        key: "Default",
        get: function get() {
          return Je;
        }
      }, {
        key: "NAME",
        get: function get() {
          return Ve;
        }
      }, {
        key: "DATA_KEY",
        get: function get() {
          return Ye;
        }
      }, {
        key: "Event",
        get: function get() {
          return rn;
        }
      }, {
        key: "EVENT_KEY",
        get: function get() {
          return ze;
        }
      }, {
        key: "DefaultType",
        get: function get() {
          return Ze;
        }
      }]), i;
    }(Be);
  g.fn[Ve] = sn._jQueryInterface, g.fn[Ve].Constructor = sn, g.fn[Ve].noConflict = function () {
    return g.fn[Ve] = Xe, sn._jQueryInterface;
  };
  var an = "scrollspy",
    ln = "bs.scrollspy",
    cn = "." + ln,
    hn = g.fn[an],
    un = {
      offset: 10,
      method: "auto",
      target: ""
    },
    fn = {
      offset: "number",
      method: "string",
      target: "(string|element)"
    },
    dn = {
      ACTIVATE: "activate" + cn,
      SCROLL: "scroll" + cn,
      LOAD_DATA_API: "load" + cn + ".data-api"
    },
    gn = "dropdown-item",
    _n = "active",
    mn = '[data-spy="scroll"]',
    pn = ".nav, .list-group",
    vn = ".nav-link",
    yn = ".nav-item",
    En = ".list-group-item",
    Cn = ".dropdown",
    Tn = ".dropdown-item",
    Sn = ".dropdown-toggle",
    bn = "offset",
    In = "position",
    Dn = function () {
      function n(t, e) {
        var n = this;
        this._element = t, this._scrollElement = "BODY" === t.tagName ? window : t, this._config = this._getConfig(e), this._selector = this._config.target + " " + vn + "," + this._config.target + " " + En + "," + this._config.target + " " + Tn, this._offsets = [], this._targets = [], this._activeTarget = null, this._scrollHeight = 0, g(this._scrollElement).on(dn.SCROLL, function (t) {
          return n._process(t);
        }), this.refresh(), this._process();
      }
      var t = n.prototype;
      return t.refresh = function () {
        var e = this,
          t = this._scrollElement === this._scrollElement.window ? bn : In,
          o = "auto" === this._config.method ? t : this._config.method,
          r = o === In ? this._getScrollTop() : 0;
        this._offsets = [], this._targets = [], this._scrollHeight = this._getScrollHeight(), [].slice.call(document.querySelectorAll(this._selector)).map(function (t) {
          var e,
            n = _.getSelectorFromElement(t);
          if (n && (e = document.querySelector(n)), e) {
            var i = e.getBoundingClientRect();
            if (i.width || i.height) return [g(e)[o]().top + r, n];
          }
          return null;
        }).filter(function (t) {
          return t;
        }).sort(function (t, e) {
          return t[0] - e[0];
        }).forEach(function (t) {
          e._offsets.push(t[0]), e._targets.push(t[1]);
        });
      }, t.dispose = function () {
        g.removeData(this._element, ln), g(this._scrollElement).off(cn), this._element = null, this._scrollElement = null, this._config = null, this._selector = null, this._offsets = null, this._targets = null, this._activeTarget = null, this._scrollHeight = null;
      }, t._getConfig = function (t) {
        if ("string" != typeof (t = l({}, un, "object" == _typeof(t) && t ? t : {})).target) {
          var e = g(t.target).attr("id");
          e || (e = _.getUID(an), g(t.target).attr("id", e)), t.target = "#" + e;
        }
        return _.typeCheckConfig(an, t, fn), t;
      }, t._getScrollTop = function () {
        return this._scrollElement === window ? this._scrollElement.pageYOffset : this._scrollElement.scrollTop;
      }, t._getScrollHeight = function () {
        return this._scrollElement.scrollHeight || Math.max(document.body.scrollHeight, document.documentElement.scrollHeight);
      }, t._getOffsetHeight = function () {
        return this._scrollElement === window ? window.innerHeight : this._scrollElement.getBoundingClientRect().height;
      }, t._process = function () {
        var t = this._getScrollTop() + this._config.offset,
          e = this._getScrollHeight(),
          n = this._config.offset + e - this._getOffsetHeight();
        if (this._scrollHeight !== e && this.refresh(), n <= t) {
          var i = this._targets[this._targets.length - 1];
          this._activeTarget !== i && this._activate(i);
        } else {
          if (this._activeTarget && t < this._offsets[0] && 0 < this._offsets[0]) return this._activeTarget = null, void this._clear();
          for (var o = this._offsets.length; o--;) {
            this._activeTarget !== this._targets[o] && t >= this._offsets[o] && ("undefined" == typeof this._offsets[o + 1] || t < this._offsets[o + 1]) && this._activate(this._targets[o]);
          }
        }
      }, t._activate = function (e) {
        this._activeTarget = e, this._clear();
        var t = this._selector.split(",").map(function (t) {
            return t + '[data-target="' + e + '"],' + t + '[href="' + e + '"]';
          }),
          n = g([].slice.call(document.querySelectorAll(t.join(","))));
        n.hasClass(gn) ? (n.closest(Cn).find(Sn).addClass(_n), n.addClass(_n)) : (n.addClass(_n), n.parents(pn).prev(vn + ", " + En).addClass(_n), n.parents(pn).prev(yn).children(vn).addClass(_n)), g(this._scrollElement).trigger(dn.ACTIVATE, {
          relatedTarget: e
        });
      }, t._clear = function () {
        [].slice.call(document.querySelectorAll(this._selector)).filter(function (t) {
          return t.classList.contains(_n);
        }).forEach(function (t) {
          return t.classList.remove(_n);
        });
      }, n._jQueryInterface = function (e) {
        return this.each(function () {
          var t = g(this).data(ln);
          if (t || (t = new n(this, "object" == _typeof(e) && e), g(this).data(ln, t)), "string" == typeof e) {
            if ("undefined" == typeof t[e]) throw new TypeError('No method named "' + e + '"');
            t[e]();
          }
        });
      }, s(n, null, [{
        key: "VERSION",
        get: function get() {
          return "4.3.1";
        }
      }, {
        key: "Default",
        get: function get() {
          return un;
        }
      }]), n;
    }();
  g(window).on(dn.LOAD_DATA_API, function () {
    for (var t = [].slice.call(document.querySelectorAll(mn)), e = t.length; e--;) {
      var n = g(t[e]);
      Dn._jQueryInterface.call(n, n.data());
    }
  }), g.fn[an] = Dn._jQueryInterface, g.fn[an].Constructor = Dn, g.fn[an].noConflict = function () {
    return g.fn[an] = hn, Dn._jQueryInterface;
  };
  var wn = "bs.tab",
    An = "." + wn,
    Nn = g.fn.tab,
    On = {
      HIDE: "hide" + An,
      HIDDEN: "hidden" + An,
      SHOW: "show" + An,
      SHOWN: "shown" + An,
      CLICK_DATA_API: "click" + An + ".data-api"
    },
    kn = "dropdown-menu",
    Pn = "active",
    Ln = "disabled",
    jn = "fade",
    Hn = "show",
    Rn = ".dropdown",
    xn = ".nav, .list-group",
    Fn = ".active",
    Un = "> li > .active",
    Wn = '[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]',
    qn = ".dropdown-toggle",
    Mn = "> .dropdown-menu .active",
    Kn = function () {
      function i(t) {
        this._element = t;
      }
      var t = i.prototype;
      return t.show = function () {
        var n = this;
        if (!(this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE && g(this._element).hasClass(Pn) || g(this._element).hasClass(Ln))) {
          var t,
            i,
            e = g(this._element).closest(xn)[0],
            o = _.getSelectorFromElement(this._element);
          if (e) {
            var r = "UL" === e.nodeName || "OL" === e.nodeName ? Un : Fn;
            i = (i = g.makeArray(g(e).find(r)))[i.length - 1];
          }
          var s = g.Event(On.HIDE, {
              relatedTarget: this._element
            }),
            a = g.Event(On.SHOW, {
              relatedTarget: i
            });
          if (i && g(i).trigger(s), g(this._element).trigger(a), !a.isDefaultPrevented() && !s.isDefaultPrevented()) {
            o && (t = document.querySelector(o)), this._activate(this._element, e);
            var l = function l() {
              var t = g.Event(On.HIDDEN, {
                  relatedTarget: n._element
                }),
                e = g.Event(On.SHOWN, {
                  relatedTarget: i
                });
              g(i).trigger(t), g(n._element).trigger(e);
            };
            t ? this._activate(t, t.parentNode, l) : l();
          }
        }
      }, t.dispose = function () {
        g.removeData(this._element, wn), this._element = null;
      }, t._activate = function (t, e, n) {
        var i = this,
          o = (!e || "UL" !== e.nodeName && "OL" !== e.nodeName ? g(e).children(Fn) : g(e).find(Un))[0],
          r = n && o && g(o).hasClass(jn),
          s = function s() {
            return i._transitionComplete(t, o, n);
          };
        if (o && r) {
          var a = _.getTransitionDurationFromElement(o);
          g(o).removeClass(Hn).one(_.TRANSITION_END, s).emulateTransitionEnd(a);
        } else s();
      }, t._transitionComplete = function (t, e, n) {
        if (e) {
          g(e).removeClass(Pn);
          var i = g(e.parentNode).find(Mn)[0];
          i && g(i).removeClass(Pn), "tab" === e.getAttribute("role") && e.setAttribute("aria-selected", !1);
        }
        if (g(t).addClass(Pn), "tab" === t.getAttribute("role") && t.setAttribute("aria-selected", !0), _.reflow(t), t.classList.contains(jn) && t.classList.add(Hn), t.parentNode && g(t.parentNode).hasClass(kn)) {
          var o = g(t).closest(Rn)[0];
          if (o) {
            var r = [].slice.call(o.querySelectorAll(qn));
            g(r).addClass(Pn);
          }
          t.setAttribute("aria-expanded", !0);
        }
        n && n();
      }, i._jQueryInterface = function (n) {
        return this.each(function () {
          var t = g(this),
            e = t.data(wn);
          if (e || (e = new i(this), t.data(wn, e)), "string" == typeof n) {
            if ("undefined" == typeof e[n]) throw new TypeError('No method named "' + n + '"');
            e[n]();
          }
        });
      }, s(i, null, [{
        key: "VERSION",
        get: function get() {
          return "4.3.1";
        }
      }]), i;
    }();
  g(document).on(On.CLICK_DATA_API, Wn, function (t) {
    t.preventDefault(), Kn._jQueryInterface.call(g(this), "show");
  }), g.fn.tab = Kn._jQueryInterface, g.fn.tab.Constructor = Kn, g.fn.tab.noConflict = function () {
    return g.fn.tab = Nn, Kn._jQueryInterface;
  };
  var Qn = "toast",
    Bn = "bs.toast",
    Vn = "." + Bn,
    Yn = g.fn[Qn],
    zn = {
      CLICK_DISMISS: "click.dismiss" + Vn,
      HIDE: "hide" + Vn,
      HIDDEN: "hidden" + Vn,
      SHOW: "show" + Vn,
      SHOWN: "shown" + Vn
    },
    Xn = "fade",
    $n = "hide",
    Gn = "show",
    Jn = "showing",
    Zn = {
      animation: "boolean",
      autohide: "boolean",
      delay: "number"
    },
    ti = {
      animation: !0,
      autohide: !0,
      delay: 500
    },
    ei = '[data-dismiss="toast"]',
    ni = function () {
      function i(t, e) {
        this._element = t, this._config = this._getConfig(e), this._timeout = null, this._setListeners();
      }
      var t = i.prototype;
      return t.show = function () {
        var t = this;
        g(this._element).trigger(zn.SHOW), this._config.animation && this._element.classList.add(Xn);
        var e = function e() {
          t._element.classList.remove(Jn), t._element.classList.add(Gn), g(t._element).trigger(zn.SHOWN), t._config.autohide && t.hide();
        };
        if (this._element.classList.remove($n), this._element.classList.add(Jn), this._config.animation) {
          var n = _.getTransitionDurationFromElement(this._element);
          g(this._element).one(_.TRANSITION_END, e).emulateTransitionEnd(n);
        } else e();
      }, t.hide = function (t) {
        var e = this;
        this._element.classList.contains(Gn) && (g(this._element).trigger(zn.HIDE), t ? this._close() : this._timeout = setTimeout(function () {
          e._close();
        }, this._config.delay));
      }, t.dispose = function () {
        clearTimeout(this._timeout), this._timeout = null, this._element.classList.contains(Gn) && this._element.classList.remove(Gn), g(this._element).off(zn.CLICK_DISMISS), g.removeData(this._element, Bn), this._element = null, this._config = null;
      }, t._getConfig = function (t) {
        return t = l({}, ti, g(this._element).data(), "object" == _typeof(t) && t ? t : {}), _.typeCheckConfig(Qn, t, this.constructor.DefaultType), t;
      }, t._setListeners = function () {
        var t = this;
        g(this._element).on(zn.CLICK_DISMISS, ei, function () {
          return t.hide(!0);
        });
      }, t._close = function () {
        var t = this,
          e = function e() {
            t._element.classList.add($n), g(t._element).trigger(zn.HIDDEN);
          };
        if (this._element.classList.remove(Gn), this._config.animation) {
          var n = _.getTransitionDurationFromElement(this._element);
          g(this._element).one(_.TRANSITION_END, e).emulateTransitionEnd(n);
        } else e();
      }, i._jQueryInterface = function (n) {
        return this.each(function () {
          var t = g(this),
            e = t.data(Bn);
          if (e || (e = new i(this, "object" == _typeof(n) && n), t.data(Bn, e)), "string" == typeof n) {
            if ("undefined" == typeof e[n]) throw new TypeError('No method named "' + n + '"');
            e[n](this);
          }
        });
      }, s(i, null, [{
        key: "VERSION",
        get: function get() {
          return "4.3.1";
        }
      }, {
        key: "DefaultType",
        get: function get() {
          return Zn;
        }
      }, {
        key: "Default",
        get: function get() {
          return ti;
        }
      }]), i;
    }();
  g.fn[Qn] = ni._jQueryInterface, g.fn[Qn].Constructor = ni, g.fn[Qn].noConflict = function () {
    return g.fn[Qn] = Yn, ni._jQueryInterface;
  }, function () {
    if ("undefined" == typeof g) throw new TypeError("Bootstrap's JavaScript requires jQuery. jQuery must be included before Bootstrap's JavaScript.");
    var t = g.fn.jquery.split(" ")[0].split(".");
    if (t[0] < 2 && t[1] < 9 || 1 === t[0] && 9 === t[1] && t[2] < 1 || 4 <= t[0]) throw new Error("Bootstrap's JavaScript requires at least jQuery v1.9.1 but less than v4.0.0");
  }(), t.Util = _, t.Alert = p, t.Button = P, t.Carousel = lt, t.Collapse = bt, t.Dropdown = Jt, t.Modal = ve, t.Popover = sn, t.Scrollspy = Dn, t.Tab = Kn, t.Toast = ni, t.Tooltip = Be, Object.defineProperty(t, "__esModule", {
    value: !0
  });
});

/**
 * Owl Carousel v2.3.4
 * Copyright 2013-2018 David Deutsch
 * Licensed under: SEE LICENSE IN https://github.com/OwlCarousel2/OwlCarousel2/blob/master/LICENSE
 */
!function (a, b, c, d) {
  function e(b, c) {
    this.settings = null, this.options = a.extend({}, e.Defaults, c), this.$element = a(b), this._handlers = {}, this._plugins = {}, this._supress = {}, this._current = null, this._speed = null, this._coordinates = [], this._breakpoint = null, this._width = null, this._items = [], this._clones = [], this._mergers = [], this._widths = [], this._invalidated = {}, this._pipe = [], this._drag = {
      time: null,
      target: null,
      pointer: null,
      stage: {
        start: null,
        current: null
      },
      direction: null
    }, this._states = {
      current: {},
      tags: {
        initializing: ["busy"],
        animating: ["busy"],
        dragging: ["interacting"]
      }
    }, a.each(["onResize", "onThrottledResize"], a.proxy(function (b, c) {
      this._handlers[c] = a.proxy(this[c], this);
    }, this)), a.each(e.Plugins, a.proxy(function (a, b) {
      this._plugins[a.charAt(0).toLowerCase() + a.slice(1)] = new b(this);
    }, this)), a.each(e.Workers, a.proxy(function (b, c) {
      this._pipe.push({
        filter: c.filter,
        run: a.proxy(c.run, this)
      });
    }, this)), this.setup(), this.initialize();
  }
  e.Defaults = {
    items: 3,
    loop: !1,
    center: !1,
    rewind: !1,
    checkVisibility: !0,
    mouseDrag: !0,
    touchDrag: !0,
    pullDrag: !0,
    freeDrag: !1,
    margin: 0,
    stagePadding: 0,
    merge: !1,
    mergeFit: !0,
    autoWidth: !1,
    startPosition: 0,
    rtl: !1,
    smartSpeed: 250,
    fluidSpeed: !1,
    dragEndSpeed: !1,
    responsive: {},
    responsiveRefreshRate: 200,
    responsiveBaseElement: b,
    fallbackEasing: "swing",
    slideTransition: "",
    info: !1,
    nestedItemSelector: !1,
    itemElement: "div",
    stageElement: "div",
    refreshClass: "owl-refresh",
    loadedClass: "owl-loaded",
    loadingClass: "owl-loading",
    rtlClass: "owl-rtl",
    responsiveClass: "owl-responsive",
    dragClass: "owl-drag",
    itemClass: "owl-item",
    stageClass: "owl-stage",
    stageOuterClass: "owl-stage-outer",
    grabClass: "owl-grab"
  }, e.Width = {
    Default: "default",
    Inner: "inner",
    Outer: "outer"
  }, e.Type = {
    Event: "event",
    State: "state"
  }, e.Plugins = {}, e.Workers = [{
    filter: ["width", "settings"],
    run: function run() {
      this._width = this.$element.width();
    }
  }, {
    filter: ["width", "items", "settings"],
    run: function run(a) {
      a.current = this._items && this._items[this.relative(this._current)];
    }
  }, {
    filter: ["items", "settings"],
    run: function run() {
      this.$stage.children(".cloned").remove();
    }
  }, {
    filter: ["width", "items", "settings"],
    run: function run(a) {
      var b = this.settings.margin || "",
        c = !this.settings.autoWidth,
        d = this.settings.rtl,
        e = {
          width: "auto",
          "margin-left": d ? b : "",
          "margin-right": d ? "" : b
        };
      !c && this.$stage.children().css(e), a.css = e;
    }
  }, {
    filter: ["width", "items", "settings"],
    run: function run(a) {
      var b = (this.width() / this.settings.items).toFixed(3) - this.settings.margin,
        c = null,
        d = this._items.length,
        e = !this.settings.autoWidth,
        f = [];
      for (a.items = {
        merge: !1,
        width: b
      }; d--;) c = this._mergers[d], c = this.settings.mergeFit && Math.min(c, this.settings.items) || c, a.items.merge = c > 1 || a.items.merge, f[d] = e ? b * c : this._items[d].width();
      this._widths = f;
    }
  }, {
    filter: ["items", "settings"],
    run: function run() {
      var b = [],
        c = this._items,
        d = this.settings,
        e = Math.max(2 * d.items, 4),
        f = 2 * Math.ceil(c.length / 2),
        g = d.loop && c.length ? d.rewind ? e : Math.max(e, f) : 0,
        h = "",
        i = "";
      for (g /= 2; g > 0;) b.push(this.normalize(b.length / 2, !0)), h += c[b[b.length - 1]][0].outerHTML, b.push(this.normalize(c.length - 1 - (b.length - 1) / 2, !0)), i = c[b[b.length - 1]][0].outerHTML + i, g -= 1;
      this._clones = b, a(h).addClass("cloned").appendTo(this.$stage), a(i).addClass("cloned").prependTo(this.$stage);
    }
  }, {
    filter: ["width", "items", "settings"],
    run: function run() {
      for (var a = this.settings.rtl ? 1 : -1, b = this._clones.length + this._items.length, c = -1, d = 0, e = 0, f = []; ++c < b;) d = f[c - 1] || 0, e = this._widths[this.relative(c)] + this.settings.margin, f.push(d + e * a);
      this._coordinates = f;
    }
  }, {
    filter: ["width", "items", "settings"],
    run: function run() {
      var a = this.settings.stagePadding,
        b = this._coordinates,
        c = {
          width: Math.ceil(Math.abs(b[b.length - 1])) + 2 * a,
          "padding-left": a || "",
          "padding-right": a || ""
        };
      this.$stage.css(c);
    }
  }, {
    filter: ["width", "items", "settings"],
    run: function run(a) {
      var b = this._coordinates.length,
        c = !this.settings.autoWidth,
        d = this.$stage.children();
      if (c && a.items.merge) for (; b--;) a.css.width = this._widths[this.relative(b)], d.eq(b).css(a.css);else c && (a.css.width = a.items.width, d.css(a.css));
    }
  }, {
    filter: ["items"],
    run: function run() {
      this._coordinates.length < 1 && this.$stage.removeAttr("style");
    }
  }, {
    filter: ["width", "items", "settings"],
    run: function run(a) {
      a.current = a.current ? this.$stage.children().index(a.current) : 0, a.current = Math.max(this.minimum(), Math.min(this.maximum(), a.current)), this.reset(a.current);
    }
  }, {
    filter: ["position"],
    run: function run() {
      this.animate(this.coordinates(this._current));
    }
  }, {
    filter: ["width", "position", "items", "settings"],
    run: function run() {
      var a,
        b,
        c,
        d,
        e = this.settings.rtl ? 1 : -1,
        f = 2 * this.settings.stagePadding,
        g = this.coordinates(this.current()) + f,
        h = g + this.width() * e,
        i = [];
      for (c = 0, d = this._coordinates.length; c < d; c++) a = this._coordinates[c - 1] || 0, b = Math.abs(this._coordinates[c]) + f * e, (this.op(a, "<=", g) && this.op(a, ">", h) || this.op(b, "<", g) && this.op(b, ">", h)) && i.push(c);
      this.$stage.children(".active").removeClass("active"), this.$stage.children(":eq(" + i.join("), :eq(") + ")").addClass("active"), this.$stage.children(".center").removeClass("center"), this.settings.center && this.$stage.children().eq(this.current()).addClass("center");
    }
  }], e.prototype.initializeStage = function () {
    this.$stage = this.$element.find("." + this.settings.stageClass), this.$stage.length || (this.$element.addClass(this.options.loadingClass), this.$stage = a("<" + this.settings.stageElement + ">", {
      "class": this.settings.stageClass
    }).wrap(a("<div/>", {
      "class": this.settings.stageOuterClass
    })), this.$element.append(this.$stage.parent()));
  }, e.prototype.initializeItems = function () {
    var b = this.$element.find(".owl-item");
    if (b.length) return this._items = b.get().map(function (b) {
      return a(b);
    }), this._mergers = this._items.map(function () {
      return 1;
    }), void this.refresh();
    this.replace(this.$element.children().not(this.$stage.parent())), this.isVisible() ? this.refresh() : this.invalidate("width"), this.$element.removeClass(this.options.loadingClass).addClass(this.options.loadedClass);
  }, e.prototype.initialize = function () {
    if (this.enter("initializing"), this.trigger("initialize"), this.$element.toggleClass(this.settings.rtlClass, this.settings.rtl), this.settings.autoWidth && !this.is("pre-loading")) {
      var a, b, c;
      a = this.$element.find("img"), b = this.settings.nestedItemSelector ? "." + this.settings.nestedItemSelector : d, c = this.$element.children(b).width(), a.length && c <= 0 && this.preloadAutoWidthImages(a);
    }
    this.initializeStage(), this.initializeItems(), this.registerEventHandlers(), this.leave("initializing"), this.trigger("initialized");
  }, e.prototype.isVisible = function () {
    return !this.settings.checkVisibility || this.$element.is(":visible");
  }, e.prototype.setup = function () {
    var b = this.viewport(),
      c = this.options.responsive,
      d = -1,
      e = null;
    c ? (a.each(c, function (a) {
      a <= b && a > d && (d = Number(a));
    }), e = a.extend({}, this.options, c[d]), "function" == typeof e.stagePadding && (e.stagePadding = e.stagePadding()), delete e.responsive, e.responsiveClass && this.$element.attr("class", this.$element.attr("class").replace(new RegExp("(" + this.options.responsiveClass + "-)\\S+\\s", "g"), "$1" + d))) : e = a.extend({}, this.options), this.trigger("change", {
      property: {
        name: "settings",
        value: e
      }
    }), this._breakpoint = d, this.settings = e, this.invalidate("settings"), this.trigger("changed", {
      property: {
        name: "settings",
        value: this.settings
      }
    });
  }, e.prototype.optionsLogic = function () {
    this.settings.autoWidth && (this.settings.stagePadding = !1, this.settings.merge = !1);
  }, e.prototype.prepare = function (b) {
    var c = this.trigger("prepare", {
      content: b
    });
    return c.data || (c.data = a("<" + this.settings.itemElement + "/>").addClass(this.options.itemClass).append(b)), this.trigger("prepared", {
      content: c.data
    }), c.data;
  }, e.prototype.update = function () {
    for (var b = 0, c = this._pipe.length, d = a.proxy(function (a) {
        return this[a];
      }, this._invalidated), e = {}; b < c;) (this._invalidated.all || a.grep(this._pipe[b].filter, d).length > 0) && this._pipe[b].run(e), b++;
    this._invalidated = {}, !this.is("valid") && this.enter("valid");
  }, e.prototype.width = function (a) {
    switch (a = a || e.Width.Default) {
      case e.Width.Inner:
      case e.Width.Outer:
        return this._width;
      default:
        return this._width - 2 * this.settings.stagePadding + this.settings.margin;
    }
  }, e.prototype.refresh = function () {
    this.enter("refreshing"), this.trigger("refresh"), this.setup(), this.optionsLogic(), this.$element.addClass(this.options.refreshClass), this.update(), this.$element.removeClass(this.options.refreshClass), this.leave("refreshing"), this.trigger("refreshed");
  }, e.prototype.onThrottledResize = function () {
    b.clearTimeout(this.resizeTimer), this.resizeTimer = b.setTimeout(this._handlers.onResize, this.settings.responsiveRefreshRate);
  }, e.prototype.onResize = function () {
    return !!this._items.length && this._width !== this.$element.width() && !!this.isVisible() && (this.enter("resizing"), this.trigger("resize").isDefaultPrevented() ? (this.leave("resizing"), !1) : (this.invalidate("width"), this.refresh(), this.leave("resizing"), void this.trigger("resized")));
  }, e.prototype.registerEventHandlers = function () {
    a.support.transition && this.$stage.on(a.support.transition.end + ".owl.core", a.proxy(this.onTransitionEnd, this)), !1 !== this.settings.responsive && this.on(b, "resize", this._handlers.onThrottledResize), this.settings.mouseDrag && (this.$element.addClass(this.options.dragClass), this.$stage.on("mousedown.owl.core", a.proxy(this.onDragStart, this)), this.$stage.on("dragstart.owl.core selectstart.owl.core", function () {
      return !1;
    })), this.settings.touchDrag && (this.$stage.on("touchstart.owl.core", a.proxy(this.onDragStart, this)), this.$stage.on("touchcancel.owl.core", a.proxy(this.onDragEnd, this)));
  }, e.prototype.onDragStart = function (b) {
    var d = null;
    3 !== b.which && (a.support.transform ? (d = this.$stage.css("transform").replace(/.*\(|\)| /g, "").split(","), d = {
      x: d[16 === d.length ? 12 : 4],
      y: d[16 === d.length ? 13 : 5]
    }) : (d = this.$stage.position(), d = {
      x: this.settings.rtl ? d.left + this.$stage.width() - this.width() + this.settings.margin : d.left,
      y: d.top
    }), this.is("animating") && (a.support.transform ? this.animate(d.x) : this.$stage.stop(), this.invalidate("position")), this.$element.toggleClass(this.options.grabClass, "mousedown" === b.type), this.speed(0), this._drag.time = new Date().getTime(), this._drag.target = a(b.target), this._drag.stage.start = d, this._drag.stage.current = d, this._drag.pointer = this.pointer(b), a(c).on("mouseup.owl.core touchend.owl.core", a.proxy(this.onDragEnd, this)), a(c).one("mousemove.owl.core touchmove.owl.core", a.proxy(function (b) {
      var d = this.difference(this._drag.pointer, this.pointer(b));
      a(c).on("mousemove.owl.core touchmove.owl.core", a.proxy(this.onDragMove, this)), Math.abs(d.x) < Math.abs(d.y) && this.is("valid") || (b.preventDefault(), this.enter("dragging"), this.trigger("drag"));
    }, this)));
  }, e.prototype.onDragMove = function (a) {
    var b = null,
      c = null,
      d = null,
      e = this.difference(this._drag.pointer, this.pointer(a)),
      f = this.difference(this._drag.stage.start, e);
    this.is("dragging") && (a.preventDefault(), this.settings.loop ? (b = this.coordinates(this.minimum()), c = this.coordinates(this.maximum() + 1) - b, f.x = ((f.x - b) % c + c) % c + b) : (b = this.settings.rtl ? this.coordinates(this.maximum()) : this.coordinates(this.minimum()), c = this.settings.rtl ? this.coordinates(this.minimum()) : this.coordinates(this.maximum()), d = this.settings.pullDrag ? -1 * e.x / 5 : 0, f.x = Math.max(Math.min(f.x, b + d), c + d)), this._drag.stage.current = f, this.animate(f.x));
  }, e.prototype.onDragEnd = function (b) {
    var d = this.difference(this._drag.pointer, this.pointer(b)),
      e = this._drag.stage.current,
      f = d.x > 0 ^ this.settings.rtl ? "left" : "right";
    a(c).off(".owl.core"), this.$element.removeClass(this.options.grabClass), (0 !== d.x && this.is("dragging") || !this.is("valid")) && (this.speed(this.settings.dragEndSpeed || this.settings.smartSpeed), this.current(this.closest(e.x, 0 !== d.x ? f : this._drag.direction)), this.invalidate("position"), this.update(), this._drag.direction = f, (Math.abs(d.x) > 3 || new Date().getTime() - this._drag.time > 300) && this._drag.target.one("click.owl.core", function () {
      return !1;
    })), this.is("dragging") && (this.leave("dragging"), this.trigger("dragged"));
  }, e.prototype.closest = function (b, c) {
    var e = -1,
      f = 30,
      g = this.width(),
      h = this.coordinates();
    return this.settings.freeDrag || a.each(h, a.proxy(function (a, i) {
      return "left" === c && b > i - f && b < i + f ? e = a : "right" === c && b > i - g - f && b < i - g + f ? e = a + 1 : this.op(b, "<", i) && this.op(b, ">", h[a + 1] !== d ? h[a + 1] : i - g) && (e = "left" === c ? a + 1 : a), -1 === e;
    }, this)), this.settings.loop || (this.op(b, ">", h[this.minimum()]) ? e = b = this.minimum() : this.op(b, "<", h[this.maximum()]) && (e = b = this.maximum())), e;
  }, e.prototype.animate = function (b) {
    var c = this.speed() > 0;
    this.is("animating") && this.onTransitionEnd(), c && (this.enter("animating"), this.trigger("translate")), a.support.transform3d && a.support.transition ? this.$stage.css({
      transform: "translate3d(" + b + "px,0px,0px)",
      transition: this.speed() / 1e3 + "s" + (this.settings.slideTransition ? " " + this.settings.slideTransition : "")
    }) : c ? this.$stage.animate({
      left: b + "px"
    }, this.speed(), this.settings.fallbackEasing, a.proxy(this.onTransitionEnd, this)) : this.$stage.css({
      left: b + "px"
    });
  }, e.prototype.is = function (a) {
    return this._states.current[a] && this._states.current[a] > 0;
  }, e.prototype.current = function (a) {
    if (a === d) return this._current;
    if (0 === this._items.length) return d;
    if (a = this.normalize(a), this._current !== a) {
      var b = this.trigger("change", {
        property: {
          name: "position",
          value: a
        }
      });
      b.data !== d && (a = this.normalize(b.data)), this._current = a, this.invalidate("position"), this.trigger("changed", {
        property: {
          name: "position",
          value: this._current
        }
      });
    }
    return this._current;
  }, e.prototype.invalidate = function (b) {
    return "string" === a.type(b) && (this._invalidated[b] = !0, this.is("valid") && this.leave("valid")), a.map(this._invalidated, function (a, b) {
      return b;
    });
  }, e.prototype.reset = function (a) {
    (a = this.normalize(a)) !== d && (this._speed = 0, this._current = a, this.suppress(["translate", "translated"]), this.animate(this.coordinates(a)), this.release(["translate", "translated"]));
  }, e.prototype.normalize = function (a, b) {
    var c = this._items.length,
      e = b ? 0 : this._clones.length;
    return !this.isNumeric(a) || c < 1 ? a = d : (a < 0 || a >= c + e) && (a = ((a - e / 2) % c + c) % c + e / 2), a;
  }, e.prototype.relative = function (a) {
    return a -= this._clones.length / 2, this.normalize(a, !0);
  }, e.prototype.maximum = function (a) {
    var b,
      c,
      d,
      e = this.settings,
      f = this._coordinates.length;
    if (e.loop) f = this._clones.length / 2 + this._items.length - 1;else if (e.autoWidth || e.merge) {
      if (b = this._items.length) for (c = this._items[--b].width(), d = this.$element.width(); b-- && !((c += this._items[b].width() + this.settings.margin) > d););
      f = b + 1;
    } else f = e.center ? this._items.length - 1 : this._items.length - e.items;
    return a && (f -= this._clones.length / 2), Math.max(f, 0);
  }, e.prototype.minimum = function (a) {
    return a ? 0 : this._clones.length / 2;
  }, e.prototype.items = function (a) {
    return a === d ? this._items.slice() : (a = this.normalize(a, !0), this._items[a]);
  }, e.prototype.mergers = function (a) {
    return a === d ? this._mergers.slice() : (a = this.normalize(a, !0), this._mergers[a]);
  }, e.prototype.clones = function (b) {
    var c = this._clones.length / 2,
      e = c + this._items.length,
      f = function f(a) {
        return a % 2 == 0 ? e + a / 2 : c - (a + 1) / 2;
      };
    return b === d ? a.map(this._clones, function (a, b) {
      return f(b);
    }) : a.map(this._clones, function (a, c) {
      return a === b ? f(c) : null;
    });
  }, e.prototype.speed = function (a) {
    return a !== d && (this._speed = a), this._speed;
  }, e.prototype.coordinates = function (b) {
    var c,
      e = 1,
      f = b - 1;
    return b === d ? a.map(this._coordinates, a.proxy(function (a, b) {
      return this.coordinates(b);
    }, this)) : (this.settings.center ? (this.settings.rtl && (e = -1, f = b + 1), c = this._coordinates[b], c += (this.width() - c + (this._coordinates[f] || 0)) / 2 * e) : c = this._coordinates[f] || 0, c = Math.ceil(c));
  }, e.prototype.duration = function (a, b, c) {
    return 0 === c ? 0 : Math.min(Math.max(Math.abs(b - a), 1), 6) * Math.abs(c || this.settings.smartSpeed);
  }, e.prototype.to = function (a, b) {
    var c = this.current(),
      d = null,
      e = a - this.relative(c),
      f = (e > 0) - (e < 0),
      g = this._items.length,
      h = this.minimum(),
      i = this.maximum();
    this.settings.loop ? (!this.settings.rewind && Math.abs(e) > g / 2 && (e += -1 * f * g), a = c + e, (d = ((a - h) % g + g) % g + h) !== a && d - e <= i && d - e > 0 && (c = d - e, a = d, this.reset(c))) : this.settings.rewind ? (i += 1, a = (a % i + i) % i) : a = Math.max(h, Math.min(i, a)), this.speed(this.duration(c, a, b)), this.current(a), this.isVisible() && this.update();
  }, e.prototype.next = function (a) {
    a = a || !1, this.to(this.relative(this.current()) + 1, a);
  }, e.prototype.prev = function (a) {
    a = a || !1, this.to(this.relative(this.current()) - 1, a);
  }, e.prototype.onTransitionEnd = function (a) {
    if (a !== d && (a.stopPropagation(), (a.target || a.srcElement || a.originalTarget) !== this.$stage.get(0))) return !1;
    this.leave("animating"), this.trigger("translated");
  }, e.prototype.viewport = function () {
    var d;
    return this.options.responsiveBaseElement !== b ? d = a(this.options.responsiveBaseElement).width() : b.innerWidth ? d = b.innerWidth : c.documentElement && c.documentElement.clientWidth ? d = c.documentElement.clientWidth : console.warn("Can not detect viewport width."), d;
  }, e.prototype.replace = function (b) {
    this.$stage.empty(), this._items = [], b && (b = b instanceof jQuery ? b : a(b)), this.settings.nestedItemSelector && (b = b.find("." + this.settings.nestedItemSelector)), b.filter(function () {
      return 1 === this.nodeType;
    }).each(a.proxy(function (a, b) {
      b = this.prepare(b), this.$stage.append(b), this._items.push(b), this._mergers.push(1 * b.find("[data-merge]").addBack("[data-merge]").attr("data-merge") || 1);
    }, this)), this.reset(this.isNumeric(this.settings.startPosition) ? this.settings.startPosition : 0), this.invalidate("items");
  }, e.prototype.add = function (b, c) {
    var e = this.relative(this._current);
    c = c === d ? this._items.length : this.normalize(c, !0), b = b instanceof jQuery ? b : a(b), this.trigger("add", {
      content: b,
      position: c
    }), b = this.prepare(b), 0 === this._items.length || c === this._items.length ? (0 === this._items.length && this.$stage.append(b), 0 !== this._items.length && this._items[c - 1].after(b), this._items.push(b), this._mergers.push(1 * b.find("[data-merge]").addBack("[data-merge]").attr("data-merge") || 1)) : (this._items[c].before(b), this._items.splice(c, 0, b), this._mergers.splice(c, 0, 1 * b.find("[data-merge]").addBack("[data-merge]").attr("data-merge") || 1)), this._items[e] && this.reset(this._items[e].index()), this.invalidate("items"), this.trigger("added", {
      content: b,
      position: c
    });
  }, e.prototype.remove = function (a) {
    (a = this.normalize(a, !0)) !== d && (this.trigger("remove", {
      content: this._items[a],
      position: a
    }), this._items[a].remove(), this._items.splice(a, 1), this._mergers.splice(a, 1), this.invalidate("items"), this.trigger("removed", {
      content: null,
      position: a
    }));
  }, e.prototype.preloadAutoWidthImages = function (b) {
    b.each(a.proxy(function (b, c) {
      this.enter("pre-loading"), c = a(c), a(new Image()).one("load", a.proxy(function (a) {
        c.attr("src", a.target.src), c.css("opacity", 1), this.leave("pre-loading"), !this.is("pre-loading") && !this.is("initializing") && this.refresh();
      }, this)).attr("src", c.attr("src") || c.attr("data-src") || c.attr("data-src-retina"));
    }, this));
  }, e.prototype.destroy = function () {
    this.$element.off(".owl.core"), this.$stage.off(".owl.core"), a(c).off(".owl.core"), !1 !== this.settings.responsive && (b.clearTimeout(this.resizeTimer), this.off(b, "resize", this._handlers.onThrottledResize));
    for (var d in this._plugins) this._plugins[d].destroy();
    this.$stage.children(".cloned").remove(), this.$stage.unwrap(), this.$stage.children().contents().unwrap(), this.$stage.children().unwrap(), this.$stage.remove(), this.$element.removeClass(this.options.refreshClass).removeClass(this.options.loadingClass).removeClass(this.options.loadedClass).removeClass(this.options.rtlClass).removeClass(this.options.dragClass).removeClass(this.options.grabClass).attr("class", this.$element.attr("class").replace(new RegExp(this.options.responsiveClass + "-\\S+\\s", "g"), "")).removeData("owl.carousel");
  }, e.prototype.op = function (a, b, c) {
    var d = this.settings.rtl;
    switch (b) {
      case "<":
        return d ? a > c : a < c;
      case ">":
        return d ? a < c : a > c;
      case ">=":
        return d ? a <= c : a >= c;
      case "<=":
        return d ? a >= c : a <= c;
    }
  }, e.prototype.on = function (a, b, c, d) {
    a.addEventListener ? a.addEventListener(b, c, d) : a.attachEvent && a.attachEvent("on" + b, c);
  }, e.prototype.off = function (a, b, c, d) {
    a.removeEventListener ? a.removeEventListener(b, c, d) : a.detachEvent && a.detachEvent("on" + b, c);
  }, e.prototype.trigger = function (b, c, d, f, g) {
    var h = {
        item: {
          count: this._items.length,
          index: this.current()
        }
      },
      i = a.camelCase(a.grep(["on", b, d], function (a) {
        return a;
      }).join("-").toLowerCase()),
      j = a.Event([b, "owl", d || "carousel"].join(".").toLowerCase(), a.extend({
        relatedTarget: this
      }, h, c));
    return this._supress[b] || (a.each(this._plugins, function (a, b) {
      b.onTrigger && b.onTrigger(j);
    }), this.register({
      type: e.Type.Event,
      name: b
    }), this.$element.trigger(j), this.settings && "function" == typeof this.settings[i] && this.settings[i].call(this, j)), j;
  }, e.prototype.enter = function (b) {
    a.each([b].concat(this._states.tags[b] || []), a.proxy(function (a, b) {
      this._states.current[b] === d && (this._states.current[b] = 0), this._states.current[b]++;
    }, this));
  }, e.prototype.leave = function (b) {
    a.each([b].concat(this._states.tags[b] || []), a.proxy(function (a, b) {
      this._states.current[b]--;
    }, this));
  }, e.prototype.register = function (b) {
    if (b.type === e.Type.Event) {
      if (a.event.special[b.name] || (a.event.special[b.name] = {}), !a.event.special[b.name].owl) {
        var c = a.event.special[b.name]._default;
        a.event.special[b.name]._default = function (a) {
          return !c || !c.apply || a.namespace && -1 !== a.namespace.indexOf("owl") ? a.namespace && a.namespace.indexOf("owl") > -1 : c.apply(this, arguments);
        }, a.event.special[b.name].owl = !0;
      }
    } else b.type === e.Type.State && (this._states.tags[b.name] ? this._states.tags[b.name] = this._states.tags[b.name].concat(b.tags) : this._states.tags[b.name] = b.tags, this._states.tags[b.name] = a.grep(this._states.tags[b.name], a.proxy(function (c, d) {
      return a.inArray(c, this._states.tags[b.name]) === d;
    }, this)));
  }, e.prototype.suppress = function (b) {
    a.each(b, a.proxy(function (a, b) {
      this._supress[b] = !0;
    }, this));
  }, e.prototype.release = function (b) {
    a.each(b, a.proxy(function (a, b) {
      delete this._supress[b];
    }, this));
  }, e.prototype.pointer = function (a) {
    var c = {
      x: null,
      y: null
    };
    return a = a.originalEvent || a || b.event, a = a.touches && a.touches.length ? a.touches[0] : a.changedTouches && a.changedTouches.length ? a.changedTouches[0] : a, a.pageX ? (c.x = a.pageX, c.y = a.pageY) : (c.x = a.clientX, c.y = a.clientY), c;
  }, e.prototype.isNumeric = function (a) {
    return !isNaN(parseFloat(a));
  }, e.prototype.difference = function (a, b) {
    return {
      x: a.x - b.x,
      y: a.y - b.y
    };
  }, a.fn.owlCarousel = function (b) {
    var c = Array.prototype.slice.call(arguments, 1);
    return this.each(function () {
      var d = a(this),
        f = d.data("owl.carousel");
      f || (f = new e(this, "object" == _typeof(b) && b), d.data("owl.carousel", f), a.each(["next", "prev", "to", "destroy", "refresh", "replace", "add", "remove"], function (b, c) {
        f.register({
          type: e.Type.Event,
          name: c
        }), f.$element.on(c + ".owl.carousel.core", a.proxy(function (a) {
          a.namespace && a.relatedTarget !== this && (this.suppress([c]), f[c].apply(this, [].slice.call(arguments, 1)), this.release([c]));
        }, f));
      })), "string" == typeof b && "_" !== b.charAt(0) && f[b].apply(f, c);
    });
  }, a.fn.owlCarousel.Constructor = e;
}(window.Zepto || window.jQuery, window, document), function (a, b, c, d) {
  var e = function e(b) {
    this._core = b, this._interval = null, this._visible = null, this._handlers = {
      "initialized.owl.carousel": a.proxy(function (a) {
        a.namespace && this._core.settings.autoRefresh && this.watch();
      }, this)
    }, this._core.options = a.extend({}, e.Defaults, this._core.options), this._core.$element.on(this._handlers);
  };
  e.Defaults = {
    autoRefresh: !0,
    autoRefreshInterval: 500
  }, e.prototype.watch = function () {
    this._interval || (this._visible = this._core.isVisible(), this._interval = b.setInterval(a.proxy(this.refresh, this), this._core.settings.autoRefreshInterval));
  }, e.prototype.refresh = function () {
    this._core.isVisible() !== this._visible && (this._visible = !this._visible, this._core.$element.toggleClass("owl-hidden", !this._visible), this._visible && this._core.invalidate("width") && this._core.refresh());
  }, e.prototype.destroy = function () {
    var a, c;
    b.clearInterval(this._interval);
    for (a in this._handlers) this._core.$element.off(a, this._handlers[a]);
    for (c in Object.getOwnPropertyNames(this)) "function" != typeof this[c] && (this[c] = null);
  }, a.fn.owlCarousel.Constructor.Plugins.AutoRefresh = e;
}(window.Zepto || window.jQuery, window, document), function (a, b, c, d) {
  var e = function e(b) {
    this._core = b, this._loaded = [], this._handlers = {
      "initialized.owl.carousel change.owl.carousel resized.owl.carousel": a.proxy(function (b) {
        if (b.namespace && this._core.settings && this._core.settings.lazyLoad && (b.property && "position" == b.property.name || "initialized" == b.type)) {
          var c = this._core.settings,
            e = c.center && Math.ceil(c.items / 2) || c.items,
            f = c.center && -1 * e || 0,
            g = (b.property && b.property.value !== d ? b.property.value : this._core.current()) + f,
            h = this._core.clones().length,
            i = a.proxy(function (a, b) {
              this.load(b);
            }, this);
          for (c.lazyLoadEager > 0 && (e += c.lazyLoadEager, c.loop && (g -= c.lazyLoadEager, e++)); f++ < e;) this.load(h / 2 + this._core.relative(g)), h && a.each(this._core.clones(this._core.relative(g)), i), g++;
        }
      }, this)
    }, this._core.options = a.extend({}, e.Defaults, this._core.options), this._core.$element.on(this._handlers);
  };
  e.Defaults = {
    lazyLoad: !1,
    lazyLoadEager: 0
  }, e.prototype.load = function (c) {
    var d = this._core.$stage.children().eq(c),
      e = d && d.find(".owl-lazy");
    !e || a.inArray(d.get(0), this._loaded) > -1 || (e.each(a.proxy(function (c, d) {
      var e,
        f = a(d),
        g = b.devicePixelRatio > 1 && f.attr("data-src-retina") || f.attr("data-src") || f.attr("data-srcset");
      this._core.trigger("load", {
        element: f,
        url: g
      }, "lazy"), f.is("img") ? f.one("load.owl.lazy", a.proxy(function () {
        f.css("opacity", 1), this._core.trigger("loaded", {
          element: f,
          url: g
        }, "lazy");
      }, this)).attr("src", g) : f.is("source") ? f.one("load.owl.lazy", a.proxy(function () {
        this._core.trigger("loaded", {
          element: f,
          url: g
        }, "lazy");
      }, this)).attr("srcset", g) : (e = new Image(), e.onload = a.proxy(function () {
        f.css({
          "background-image": 'url("' + g + '")',
          opacity: "1"
        }), this._core.trigger("loaded", {
          element: f,
          url: g
        }, "lazy");
      }, this), e.src = g);
    }, this)), this._loaded.push(d.get(0)));
  }, e.prototype.destroy = function () {
    var a, b;
    for (a in this.handlers) this._core.$element.off(a, this.handlers[a]);
    for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null);
  }, a.fn.owlCarousel.Constructor.Plugins.Lazy = e;
}(window.Zepto || window.jQuery, window, document), function (a, b, c, d) {
  var e = function e(c) {
    this._core = c, this._previousHeight = null, this._handlers = {
      "initialized.owl.carousel refreshed.owl.carousel": a.proxy(function (a) {
        a.namespace && this._core.settings.autoHeight && this.update();
      }, this),
      "changed.owl.carousel": a.proxy(function (a) {
        a.namespace && this._core.settings.autoHeight && "position" === a.property.name && this.update();
      }, this),
      "loaded.owl.lazy": a.proxy(function (a) {
        a.namespace && this._core.settings.autoHeight && a.element.closest("." + this._core.settings.itemClass).index() === this._core.current() && this.update();
      }, this)
    }, this._core.options = a.extend({}, e.Defaults, this._core.options), this._core.$element.on(this._handlers), this._intervalId = null;
    var d = this;
    a(b).on("load", function () {
      d._core.settings.autoHeight && d.update();
    }), a(b).resize(function () {
      d._core.settings.autoHeight && (null != d._intervalId && clearTimeout(d._intervalId), d._intervalId = setTimeout(function () {
        d.update();
      }, 250));
    });
  };
  e.Defaults = {
    autoHeight: !1,
    autoHeightClass: "owl-height"
  }, e.prototype.update = function () {
    var b = this._core._current,
      c = b + this._core.settings.items,
      d = this._core.settings.lazyLoad,
      e = this._core.$stage.children().toArray().slice(b, c),
      f = [],
      g = 0;
    a.each(e, function (b, c) {
      f.push(a(c).height());
    }), g = Math.max.apply(null, f), g <= 1 && d && this._previousHeight && (g = this._previousHeight), this._previousHeight = g, this._core.$stage.parent().height(g).addClass(this._core.settings.autoHeightClass);
  }, e.prototype.destroy = function () {
    var a, b;
    for (a in this._handlers) this._core.$element.off(a, this._handlers[a]);
    for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null);
  }, a.fn.owlCarousel.Constructor.Plugins.AutoHeight = e;
}(window.Zepto || window.jQuery, window, document), function (a, b, c, d) {
  var e = function e(b) {
    this._core = b, this._videos = {}, this._playing = null, this._handlers = {
      "initialized.owl.carousel": a.proxy(function (a) {
        a.namespace && this._core.register({
          type: "state",
          name: "playing",
          tags: ["interacting"]
        });
      }, this),
      "resize.owl.carousel": a.proxy(function (a) {
        a.namespace && this._core.settings.video && this.isInFullScreen() && a.preventDefault();
      }, this),
      "refreshed.owl.carousel": a.proxy(function (a) {
        a.namespace && this._core.is("resizing") && this._core.$stage.find(".cloned .owl-video-frame").remove();
      }, this),
      "changed.owl.carousel": a.proxy(function (a) {
        a.namespace && "position" === a.property.name && this._playing && this.stop();
      }, this),
      "prepared.owl.carousel": a.proxy(function (b) {
        if (b.namespace) {
          var c = a(b.content).find(".owl-video");
          c.length && (c.css("display", "none"), this.fetch(c, a(b.content)));
        }
      }, this)
    }, this._core.options = a.extend({}, e.Defaults, this._core.options), this._core.$element.on(this._handlers), this._core.$element.on("click.owl.video", ".owl-video-play-icon", a.proxy(function (a) {
      this.play(a);
    }, this));
  };
  e.Defaults = {
    video: !1,
    videoHeight: !1,
    videoWidth: !1
  }, e.prototype.fetch = function (a, b) {
    var c = function () {
        return a.attr("data-vimeo-id") ? "vimeo" : a.attr("data-vzaar-id") ? "vzaar" : "youtube";
      }(),
      d = a.attr("data-vimeo-id") || a.attr("data-youtube-id") || a.attr("data-vzaar-id"),
      e = a.attr("data-width") || this._core.settings.videoWidth,
      f = a.attr("data-height") || this._core.settings.videoHeight,
      g = a.attr("href");
    if (!g) throw new Error("Missing video URL.");
    if (d = g.match(/(http:|https:|)\/\/(player.|www.|app.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com|be\-nocookie\.com)|vzaar\.com)\/(video\/|videos\/|embed\/|channels\/.+\/|groups\/.+\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/), d[3].indexOf("youtu") > -1) c = "youtube";else if (d[3].indexOf("vimeo") > -1) c = "vimeo";else {
      if (!(d[3].indexOf("vzaar") > -1)) throw new Error("Video URL not supported.");
      c = "vzaar";
    }
    d = d[6], this._videos[g] = {
      type: c,
      id: d,
      width: e,
      height: f
    }, b.attr("data-video", g), this.thumbnail(a, this._videos[g]);
  }, e.prototype.thumbnail = function (b, c) {
    var d,
      e,
      f,
      g = c.width && c.height ? "width:" + c.width + "px;height:" + c.height + "px;" : "",
      h = b.find("img"),
      i = "src",
      j = "",
      k = this._core.settings,
      l = function l(c) {
        e = '<div class="owl-video-play-icon"></div>', d = k.lazyLoad ? a("<div/>", {
          "class": "owl-video-tn " + j,
          srcType: c
        }) : a("<div/>", {
          "class": "owl-video-tn",
          style: "opacity:1;background-image:url(" + c + ")"
        }), b.after(d), b.after(e);
      };
    if (b.wrap(a("<div/>", {
      "class": "owl-video-wrapper",
      style: g
    })), this._core.settings.lazyLoad && (i = "data-src", j = "owl-lazy"), h.length) return l(h.attr(i)), h.remove(), !1;
    "youtube" === c.type ? (f = "//img.youtube.com/vi/" + c.id + "/hqdefault.jpg", l(f)) : "vimeo" === c.type ? a.ajax({
      type: "GET",
      url: "//vimeo.com/api/v2/video/" + c.id + ".json",
      jsonp: "callback",
      dataType: "jsonp",
      success: function success(a) {
        f = a[0].thumbnail_large, l(f);
      }
    }) : "vzaar" === c.type && a.ajax({
      type: "GET",
      url: "//vzaar.com/api/videos/" + c.id + ".json",
      jsonp: "callback",
      dataType: "jsonp",
      success: function success(a) {
        f = a.framegrab_url, l(f);
      }
    });
  }, e.prototype.stop = function () {
    this._core.trigger("stop", null, "video"), this._playing.find(".owl-video-frame").remove(), this._playing.removeClass("owl-video-playing"), this._playing = null, this._core.leave("playing"), this._core.trigger("stopped", null, "video");
  }, e.prototype.play = function (b) {
    var c,
      d = a(b.target),
      e = d.closest("." + this._core.settings.itemClass),
      f = this._videos[e.attr("data-video")],
      g = f.width || "100%",
      h = f.height || this._core.$stage.height();
    this._playing || (this._core.enter("playing"), this._core.trigger("play", null, "video"), e = this._core.items(this._core.relative(e.index())), this._core.reset(e.index()), c = a('<iframe frameborder="0" allowfullscreen mozallowfullscreen webkitAllowFullScreen ></iframe>'), c.attr("height", h), c.attr("width", g), "youtube" === f.type ? c.attr("src", "//www.youtube.com/embed/" + f.id + "?autoplay=1&rel=0&v=" + f.id) : "vimeo" === f.type ? c.attr("src", "//player.vimeo.com/video/" + f.id + "?autoplay=1") : "vzaar" === f.type && c.attr("src", "//view.vzaar.com/" + f.id + "/player?autoplay=true"), a(c).wrap('<div class="owl-video-frame" />').insertAfter(e.find(".owl-video")), this._playing = e.addClass("owl-video-playing"));
  }, e.prototype.isInFullScreen = function () {
    var b = c.fullscreenElement || c.mozFullScreenElement || c.webkitFullscreenElement;
    return b && a(b).parent().hasClass("owl-video-frame");
  }, e.prototype.destroy = function () {
    var a, b;
    this._core.$element.off("click.owl.video");
    for (a in this._handlers) this._core.$element.off(a, this._handlers[a]);
    for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null);
  }, a.fn.owlCarousel.Constructor.Plugins.Video = e;
}(window.Zepto || window.jQuery, window, document), function (a, b, c, d) {
  var e = function e(b) {
    this.core = b, this.core.options = a.extend({}, e.Defaults, this.core.options), this.swapping = !0, this.previous = d, this.next = d, this.handlers = {
      "change.owl.carousel": a.proxy(function (a) {
        a.namespace && "position" == a.property.name && (this.previous = this.core.current(), this.next = a.property.value);
      }, this),
      "drag.owl.carousel dragged.owl.carousel translated.owl.carousel": a.proxy(function (a) {
        a.namespace && (this.swapping = "translated" == a.type);
      }, this),
      "translate.owl.carousel": a.proxy(function (a) {
        a.namespace && this.swapping && (this.core.options.animateOut || this.core.options.animateIn) && this.swap();
      }, this)
    }, this.core.$element.on(this.handlers);
  };
  e.Defaults = {
    animateOut: !1,
    animateIn: !1
  }, e.prototype.swap = function () {
    if (1 === this.core.settings.items && a.support.animation && a.support.transition) {
      this.core.speed(0);
      var b,
        c = a.proxy(this.clear, this),
        d = this.core.$stage.children().eq(this.previous),
        e = this.core.$stage.children().eq(this.next),
        f = this.core.settings.animateIn,
        g = this.core.settings.animateOut;
      this.core.current() !== this.previous && (g && (b = this.core.coordinates(this.previous) - this.core.coordinates(this.next), d.one(a.support.animation.end, c).css({
        left: b + "px"
      }).addClass("animated owl-animated-out").addClass(g)), f && e.one(a.support.animation.end, c).addClass("animated owl-animated-in").addClass(f));
    }
  }, e.prototype.clear = function (b) {
    a(b.target).css({
      left: ""
    }).removeClass("animated owl-animated-out owl-animated-in").removeClass(this.core.settings.animateIn).removeClass(this.core.settings.animateOut), this.core.onTransitionEnd();
  }, e.prototype.destroy = function () {
    var a, b;
    for (a in this.handlers) this.core.$element.off(a, this.handlers[a]);
    for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null);
  }, a.fn.owlCarousel.Constructor.Plugins.Animate = e;
}(window.Zepto || window.jQuery, window, document), function (a, b, c, d) {
  var e = function e(b) {
    this._core = b, this._call = null, this._time = 0, this._timeout = 0, this._paused = !0, this._handlers = {
      "changed.owl.carousel": a.proxy(function (a) {
        a.namespace && "settings" === a.property.name ? this._core.settings.autoplay ? this.play() : this.stop() : a.namespace && "position" === a.property.name && this._paused && (this._time = 0);
      }, this),
      "initialized.owl.carousel": a.proxy(function (a) {
        a.namespace && this._core.settings.autoplay && this.play();
      }, this),
      "play.owl.autoplay": a.proxy(function (a, b, c) {
        a.namespace && this.play(b, c);
      }, this),
      "stop.owl.autoplay": a.proxy(function (a) {
        a.namespace && this.stop();
      }, this),
      "mouseover.owl.autoplay": a.proxy(function () {
        this._core.settings.autoplayHoverPause && this._core.is("rotating") && this.pause();
      }, this),
      "mouseleave.owl.autoplay": a.proxy(function () {
        this._core.settings.autoplayHoverPause && this._core.is("rotating") && this.play();
      }, this),
      "touchstart.owl.core": a.proxy(function () {
        this._core.settings.autoplayHoverPause && this._core.is("rotating") && this.pause();
      }, this),
      "touchend.owl.core": a.proxy(function () {
        this._core.settings.autoplayHoverPause && this.play();
      }, this)
    }, this._core.$element.on(this._handlers), this._core.options = a.extend({}, e.Defaults, this._core.options);
  };
  e.Defaults = {
    autoplay: !1,
    autoplayTimeout: 5e3,
    autoplayHoverPause: !1,
    autoplaySpeed: !1
  }, e.prototype._next = function (d) {
    this._call = b.setTimeout(a.proxy(this._next, this, d), this._timeout * (Math.round(this.read() / this._timeout) + 1) - this.read()), this._core.is("interacting") || c.hidden || this._core.next(d || this._core.settings.autoplaySpeed);
  }, e.prototype.read = function () {
    return new Date().getTime() - this._time;
  }, e.prototype.play = function (c, d) {
    var e;
    this._core.is("rotating") || this._core.enter("rotating"), c = c || this._core.settings.autoplayTimeout, e = Math.min(this._time % (this._timeout || c), c), this._paused ? (this._time = this.read(), this._paused = !1) : b.clearTimeout(this._call), this._time += this.read() % c - e, this._timeout = c, this._call = b.setTimeout(a.proxy(this._next, this, d), c - e);
  }, e.prototype.stop = function () {
    this._core.is("rotating") && (this._time = 0, this._paused = !0, b.clearTimeout(this._call), this._core.leave("rotating"));
  }, e.prototype.pause = function () {
    this._core.is("rotating") && !this._paused && (this._time = this.read(), this._paused = !0, b.clearTimeout(this._call));
  }, e.prototype.destroy = function () {
    var a, b;
    this.stop();
    for (a in this._handlers) this._core.$element.off(a, this._handlers[a]);
    for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null);
  }, a.fn.owlCarousel.Constructor.Plugins.autoplay = e;
}(window.Zepto || window.jQuery, window, document), function (a, b, c, d) {
  "use strict";

  var e = function e(b) {
    this._core = b, this._initialized = !1, this._pages = [], this._controls = {}, this._templates = [], this.$element = this._core.$element, this._overrides = {
      next: this._core.next,
      prev: this._core.prev,
      to: this._core.to
    }, this._handlers = {
      "prepared.owl.carousel": a.proxy(function (b) {
        b.namespace && this._core.settings.dotsData && this._templates.push('<div class="' + this._core.settings.dotClass + '">' + a(b.content).find("[data-dot]").addBack("[data-dot]").attr("data-dot") + "</div>");
      }, this),
      "added.owl.carousel": a.proxy(function (a) {
        a.namespace && this._core.settings.dotsData && this._templates.splice(a.position, 0, this._templates.pop());
      }, this),
      "remove.owl.carousel": a.proxy(function (a) {
        a.namespace && this._core.settings.dotsData && this._templates.splice(a.position, 1);
      }, this),
      "changed.owl.carousel": a.proxy(function (a) {
        a.namespace && "position" == a.property.name && this.draw();
      }, this),
      "initialized.owl.carousel": a.proxy(function (a) {
        a.namespace && !this._initialized && (this._core.trigger("initialize", null, "navigation"), this.initialize(), this.update(), this.draw(), this._initialized = !0, this._core.trigger("initialized", null, "navigation"));
      }, this),
      "refreshed.owl.carousel": a.proxy(function (a) {
        a.namespace && this._initialized && (this._core.trigger("refresh", null, "navigation"), this.update(), this.draw(), this._core.trigger("refreshed", null, "navigation"));
      }, this)
    }, this._core.options = a.extend({}, e.Defaults, this._core.options), this.$element.on(this._handlers);
  };
  e.Defaults = {
    nav: !1,
    navText: ['<span aria-label="Previous">&#x2039;</span>', '<span aria-label="Next">&#x203a;</span>'],
    navSpeed: !1,
    navElement: 'button type="button" role="presentation"',
    navContainer: !1,
    navContainerClass: "owl-nav",
    navClass: ["owl-prev", "owl-next"],
    slideBy: 1,
    dotClass: "owl-dot",
    dotsClass: "owl-dots",
    dots: !0,
    dotsEach: !1,
    dotsData: !1,
    dotsSpeed: !1,
    dotsContainer: !1
  }, e.prototype.initialize = function () {
    var b,
      c = this._core.settings;
    this._controls.$relative = (c.navContainer ? a(c.navContainer) : a("<div>").addClass(c.navContainerClass).appendTo(this.$element)).addClass("disabled"), this._controls.$previous = a("<" + c.navElement + ">").addClass(c.navClass[0]).html(c.navText[0]).prependTo(this._controls.$relative).on("click", a.proxy(function (a) {
      this.prev(c.navSpeed);
    }, this)), this._controls.$next = a("<" + c.navElement + ">").addClass(c.navClass[1]).html(c.navText[1]).appendTo(this._controls.$relative).on("click", a.proxy(function (a) {
      this.next(c.navSpeed);
    }, this)), c.dotsData || (this._templates = [a('<button role="button">').addClass(c.dotClass).append(a("<span>")).prop("outerHTML")]), this._controls.$absolute = (c.dotsContainer ? a(c.dotsContainer) : a("<div>").addClass(c.dotsClass).appendTo(this.$element)).addClass("disabled"), this._controls.$absolute.on("click", "button", a.proxy(function (b) {
      var d = a(b.target).parent().is(this._controls.$absolute) ? a(b.target).index() : a(b.target).parent().index();
      b.preventDefault(), this.to(d, c.dotsSpeed);
    }, this));
    for (b in this._overrides) this._core[b] = a.proxy(this[b], this);
  }, e.prototype.destroy = function () {
    var a, b, c, d, e;
    e = this._core.settings;
    for (a in this._handlers) this.$element.off(a, this._handlers[a]);
    for (b in this._controls) "$relative" === b && e.navContainer ? this._controls[b].html("") : this._controls[b].remove();
    for (d in this.overides) this._core[d] = this._overrides[d];
    for (c in Object.getOwnPropertyNames(this)) "function" != typeof this[c] && (this[c] = null);
  }, e.prototype.update = function () {
    var a,
      b,
      c,
      d = this._core.clones().length / 2,
      e = d + this._core.items().length,
      f = this._core.maximum(!0),
      g = this._core.settings,
      h = g.center || g.autoWidth || g.dotsData ? 1 : g.dotsEach || g.items;
    if ("page" !== g.slideBy && (g.slideBy = Math.min(g.slideBy, g.items)), g.dots || "page" == g.slideBy) for (this._pages = [], a = d, b = 0, c = 0; a < e; a++) {
      if (b >= h || 0 === b) {
        if (this._pages.push({
          start: Math.min(f, a - d),
          end: a - d + h - 1
        }), Math.min(f, a - d) === f) break;
        b = 0, ++c;
      }
      b += this._core.mergers(this._core.relative(a));
    }
  }, e.prototype.draw = function () {
    var b,
      c = this._core.settings,
      d = this._core.items().length <= c.items,
      e = this._core.relative(this._core.current()),
      f = c.loop || c.rewind;
    this._controls.$relative.toggleClass("disabled", !c.nav || d), c.nav && (this._controls.$previous.toggleClass("disabled", !f && e <= this._core.minimum(!0)), this._controls.$next.toggleClass("disabled", !f && e >= this._core.maximum(!0))), this._controls.$absolute.toggleClass("disabled", !c.dots || d), c.dots && (b = this._pages.length - this._controls.$absolute.children().length, c.dotsData && 0 !== b ? this._controls.$absolute.html(this._templates.join("")) : b > 0 ? this._controls.$absolute.append(new Array(b + 1).join(this._templates[0])) : b < 0 && this._controls.$absolute.children().slice(b).remove(), this._controls.$absolute.find(".active").removeClass("active"), this._controls.$absolute.children().eq(a.inArray(this.current(), this._pages)).addClass("active"));
  }, e.prototype.onTrigger = function (b) {
    var c = this._core.settings;
    b.page = {
      index: a.inArray(this.current(), this._pages),
      count: this._pages.length,
      size: c && (c.center || c.autoWidth || c.dotsData ? 1 : c.dotsEach || c.items)
    };
  }, e.prototype.current = function () {
    var b = this._core.relative(this._core.current());
    return a.grep(this._pages, a.proxy(function (a, c) {
      return a.start <= b && a.end >= b;
    }, this)).pop();
  }, e.prototype.getPosition = function (b) {
    var c,
      d,
      e = this._core.settings;
    return "page" == e.slideBy ? (c = a.inArray(this.current(), this._pages), d = this._pages.length, b ? ++c : --c, c = this._pages[(c % d + d) % d].start) : (c = this._core.relative(this._core.current()), d = this._core.items().length, b ? c += e.slideBy : c -= e.slideBy), c;
  }, e.prototype.next = function (b) {
    a.proxy(this._overrides.to, this._core)(this.getPosition(!0), b);
  }, e.prototype.prev = function (b) {
    a.proxy(this._overrides.to, this._core)(this.getPosition(!1), b);
  }, e.prototype.to = function (b, c, d) {
    var e;
    !d && this._pages.length ? (e = this._pages.length, a.proxy(this._overrides.to, this._core)(this._pages[(b % e + e) % e].start, c)) : a.proxy(this._overrides.to, this._core)(b, c);
  }, a.fn.owlCarousel.Constructor.Plugins.Navigation = e;
}(window.Zepto || window.jQuery, window, document), function (a, b, c, d) {
  "use strict";

  var e = function e(c) {
    this._core = c, this._hashes = {}, this.$element = this._core.$element, this._handlers = {
      "initialized.owl.carousel": a.proxy(function (c) {
        c.namespace && "URLHash" === this._core.settings.startPosition && a(b).trigger("hashchange.owl.navigation");
      }, this),
      "prepared.owl.carousel": a.proxy(function (b) {
        if (b.namespace) {
          var c = a(b.content).find("[data-hash]").addBack("[data-hash]").attr("data-hash");
          if (!c) return;
          this._hashes[c] = b.content;
        }
      }, this),
      "changed.owl.carousel": a.proxy(function (c) {
        if (c.namespace && "position" === c.property.name) {
          var d = this._core.items(this._core.relative(this._core.current())),
            e = a.map(this._hashes, function (a, b) {
              return a === d ? b : null;
            }).join();
          if (!e || b.location.hash.slice(1) === e) return;
          b.location.hash = e;
        }
      }, this)
    }, this._core.options = a.extend({}, e.Defaults, this._core.options), this.$element.on(this._handlers), a(b).on("hashchange.owl.navigation", a.proxy(function (a) {
      var c = b.location.hash.substring(1),
        e = this._core.$stage.children(),
        f = this._hashes[c] && e.index(this._hashes[c]);
      f !== d && f !== this._core.current() && this._core.to(this._core.relative(f), !1, !0);
    }, this));
  };
  e.Defaults = {
    URLhashListener: !1
  }, e.prototype.destroy = function () {
    var c, d;
    a(b).off("hashchange.owl.navigation");
    for (c in this._handlers) this._core.$element.off(c, this._handlers[c]);
    for (d in Object.getOwnPropertyNames(this)) "function" != typeof this[d] && (this[d] = null);
  }, a.fn.owlCarousel.Constructor.Plugins.Hash = e;
}(window.Zepto || window.jQuery, window, document), function (a, b, c, d) {
  function e(b, c) {
    var e = !1,
      f = b.charAt(0).toUpperCase() + b.slice(1);
    return a.each((b + " " + h.join(f + " ") + f).split(" "), function (a, b) {
      if (g[b] !== d) return e = !c || b, !1;
    }), e;
  }
  function f(a) {
    return e(a, !0);
  }
  var g = a("<support>").get(0).style,
    h = "Webkit Moz O ms".split(" "),
    i = {
      transition: {
        end: {
          WebkitTransition: "webkitTransitionEnd",
          MozTransition: "transitionend",
          OTransition: "oTransitionEnd",
          transition: "transitionend"
        }
      },
      animation: {
        end: {
          WebkitAnimation: "webkitAnimationEnd",
          MozAnimation: "animationend",
          OAnimation: "oAnimationEnd",
          animation: "animationend"
        }
      }
    },
    j = {
      csstransforms: function csstransforms() {
        return !!e("transform");
      },
      csstransforms3d: function csstransforms3d() {
        return !!e("perspective");
      },
      csstransitions: function csstransitions() {
        return !!e("transition");
      },
      cssanimations: function cssanimations() {
        return !!e("animation");
      }
    };
  j.csstransitions() && (a.support.transition = new String(f("transition")), a.support.transition.end = i.transition.end[a.support.transition]), j.cssanimations() && (a.support.animation = new String(f("animation")), a.support.animation.end = i.animation.end[a.support.animation]), j.csstransforms() && (a.support.transform = new String(f("transform")), a.support.transform3d = j.csstransforms3d());
}(window.Zepto || window.jQuery, window, document);
(function ($) {
  $.fn.horizontalmenu = function (option) {
    var setting = {
      itemClick: function itemClick(sender) {
        return true; //if this finction return true then will be executed http request
      }
    };

    if (option) $.extend(setting, option);
    var shadowRight = 80; // width of the .ah-tab::after
    // width of the .ah-tab::before is identical to the margin-right of the tab list item

    var isHorizontalOverflow = function isHorizontalOverflow(selector) {
      var element = $(selector)[0];
      return element.scrollWidth > element.clientWidth;
    };
    var adapt = function adapt(wrapper) {
      var tab = $(wrapper).find('.ah-tab'); //tab list

      var items = tab.find('.ah-tab-item'); //tab list items
      var item = tab.find('.ah-tab-item[data-ah-tab-active="true"]'); //tab list active item

      var isOverflow = isHorizontalOverflow(tab);
      $(wrapper).find('.ah-tab-overflow-wrapper') //overflow dropdown list wrapper
      .attr('data-ah-tab-active', isOverflow);
      var marginLeft = 0,
        //distance to the left of the active item
        marginRight = 0,
        //distance to the right of the active item
        index = item.index(); //index of the active item

      if (isOverflow) {
        for (var i = 0; i < items.length; i++) {
          var current = items.eq(i);
          var width = current.width();
          var margin = parseInt(current.css('margin-left')) || 0;
          if (i < index) {
            marginRight += width + (i + 1 < index ? margin : 0);
            continue;
          }
          marginLeft -= width + margin;
        }

        //if the tab list active item doesn't fit into the tab list
        if (marginLeft + item.width() + shadowRight > $(tab).width()) {
          marginLeft *= -1;
          if (index) {
            var delta = $(tab).width() - marginLeft - shadowRight;
            //if distance to the right is less than the width of the tab list
            if (delta > 0) marginLeft += delta; //decrease distance to the left at delta
            tab.addClass('ah-tab-overflow-left');
          }
        } else {
          marginLeft = 0;
          tab.removeClass('ah-tab-overflow-left');
        }
        tab.addClass('ah-tab-overflow-right');
      } else {
        tab.removeClass('ah-tab-overflow-left ah-tab-overflow-right');
      }
      items.css({
        '-moz-transform': 'translateX(' + marginRight + 'px)',
        '-o-transform': 'translateX(' + marginRight + 'px)',
        '-webkit-transform': 'translateX(' + marginRight + 'px)',
        'transform': 'translateX(' + marginRight + 'px)'
      });
    };
    var initialize = function initialize(wrapper) {
      if (wrapper.find('.ah-tab-overflow-wrapper').length) return false;
      var items = wrapper.find('.ah-tab-item');
      items.bind('click', function () {
        var isContinue = setting.itemClick($(this));
        if (!isContinue) {
          var index = $(this).index();
          var w = $(this).closest('.ah-tab-wrapper');
          w.find('.ah-tab-item').removeAttr('data-ah-tab-active');
          w.find('.ah-tab .ah-tab-item').eq(index).attr('data-ah-tab-active', 'true');
          w.find('.ah-tab-overflow-wrapper .ah-tab-item').eq(index).attr('data-ah-tab-active', 'true');
          adapt(w);
        }
        return isContinue;
      });
      $('<div>', {
        "class": 'ah-tab-overflow-wrapper',
        append: $('<button>', {
          type: 'menu',
          "class": 'ah-tab-overflow-menu'
        }).add($('<div>', {
          "class": 'ah-tab-overflow-list',
          append: items.clone(true, true).removeAttr('style')
        }))
      }).appendTo(wrapper);
      adapt(wrapper);
      var resizeStabilizer = undefined;
      $(window).bind('resize', function () {
        if (resizeStabilizer) clearTimeout(resizeStabilizer);
        resizeStabilizer = setTimeout(function () {
          adapt(wrapper);
        }, 20);
      });
    };
    return this.each(function () {
      initialize($(this));
    });
  };
})(jQuery);
!function (i) {
  i.fn.theiaStickySidebar = function (t) {
    function e(t, e) {
      var a = o(t, e);
      a || (console.log("TSS: Body width smaller than options.minWidth. Init is delayed."), i(document).on("scroll." + t.namespace, function (t, e) {
        return function (a) {
          var n = o(t, e);
          n && i(this).unbind(a);
        };
      }(t, e)), i(window).on("resize." + t.namespace, function (t, e) {
        return function (a) {
          var n = o(t, e);
          n && i(this).unbind(a);
        };
      }(t, e)));
    }
    function o(t, e) {
      return t.initialized === !0 || !(i("body").width() < t.minWidth) && (a(t, e), !0);
    }
    function a(t, e) {
      t.initialized = !0;
      var o = i("#theia-sticky-sidebar-stylesheet-" + t.namespace);
      0 === o.length && i("head").append(i('<style id="theia-sticky-sidebar-stylesheet-' + t.namespace + '">.theiaStickySidebar:after {content: ""; display: table; clear: both;}</style>')), e.each(function () {
        function e() {
          a.fixedScrollTop = 0, a.sidebar.css({
            "min-height": "1px"
          }), a.stickySidebar.css({
            position: "static",
            width: "",
            transform: "none"
          });
        }
        function o(t) {
          var e = t.height();
          return t.children().each(function () {
            e = Math.max(e, i(this).height());
          }), e;
        }
        var a = {};
        if (a.sidebar = i(this), a.options = t || {}, a.container = i(a.options.containerSelector), 0 == a.container.length && (a.container = a.sidebar.parent()), a.sidebar.parents().css("-webkit-transform", "none"), a.sidebar.css({
          position: a.options.defaultPosition,
          overflow: "visible",
          "-webkit-box-sizing": "border-box",
          "-moz-box-sizing": "border-box",
          "box-sizing": "border-box"
        }), a.stickySidebar = a.sidebar.find(".theiaStickySidebar"), 0 == a.stickySidebar.length) {
          var s = /(?:text|application)\/(?:x-)?(?:javascript|ecmascript)/i;
          a.sidebar.find("script").filter(function (i, t) {
            return 0 === t.type.length || t.type.match(s);
          }).remove(), a.stickySidebar = i("<div>").addClass("theiaStickySidebar").append(a.sidebar.children()), a.sidebar.append(a.stickySidebar);
        }
        a.marginBottom = parseInt(a.sidebar.css("margin-bottom")), a.paddingTop = parseInt(a.sidebar.css("padding-top")), a.paddingBottom = parseInt(a.sidebar.css("padding-bottom"));
        var r = a.stickySidebar.offset().top,
          d = a.stickySidebar.outerHeight();
        a.stickySidebar.css("padding-top", 1), a.stickySidebar.css("padding-bottom", 1), r -= a.stickySidebar.offset().top, d = a.stickySidebar.outerHeight() - d - r, 0 == r ? (a.stickySidebar.css("padding-top", 0), a.stickySidebarPaddingTop = 0) : a.stickySidebarPaddingTop = 1, 0 == d ? (a.stickySidebar.css("padding-bottom", 0), a.stickySidebarPaddingBottom = 0) : a.stickySidebarPaddingBottom = 1, a.previousScrollTop = null, a.fixedScrollTop = 0, e(), a.onScroll = function (a) {
          if (a.stickySidebar.is(":visible")) {
            if (i("body").width() < a.options.minWidth) return void e();
            if (a.options.disableOnResponsiveLayouts) {
              var s = a.sidebar.outerWidth("none" == a.sidebar.css("float"));
              if (s + 50 > a.container.width()) return void e();
            }
            var r = i(document).scrollTop(),
              d = "static";
            if (r >= a.sidebar.offset().top + (a.paddingTop - a.options.additionalMarginTop)) {
              var c,
                p = a.paddingTop + t.additionalMarginTop,
                b = a.paddingBottom + a.marginBottom + t.additionalMarginBottom,
                l = a.sidebar.offset().top,
                f = a.sidebar.offset().top + o(a.container),
                h = 0 + t.additionalMarginTop,
                g = a.stickySidebar.outerHeight() + p + b < i(window).height();
              c = g ? h + a.stickySidebar.outerHeight() : i(window).height() - a.marginBottom - a.paddingBottom - t.additionalMarginBottom;
              var u = l - r + a.paddingTop,
                S = f - r - a.paddingBottom - a.marginBottom,
                y = a.stickySidebar.offset().top - r,
                m = a.previousScrollTop - r;
              "fixed" == a.stickySidebar.css("position") && "modern" == a.options.sidebarBehavior && (y += m), "stick-to-top" == a.options.sidebarBehavior && (y = t.additionalMarginTop), "stick-to-bottom" == a.options.sidebarBehavior && (y = c - a.stickySidebar.outerHeight()), y = m > 0 ? Math.min(y, h) : Math.max(y, c - a.stickySidebar.outerHeight()), y = Math.max(y, u), y = Math.min(y, S - a.stickySidebar.outerHeight());
              var k = a.container.height() == a.stickySidebar.outerHeight();
              d = (k || y != h) && (k || y != c - a.stickySidebar.outerHeight()) ? r + y - a.sidebar.offset().top - a.paddingTop <= t.additionalMarginTop ? "static" : "absolute" : "fixed";
            }
            if ("fixed" == d) {
              var v = i(document).scrollLeft();
              a.stickySidebar.css({
                position: "fixed",
                width: n(a.stickySidebar) + "px",
                transform: "translateY(" + y + "px)",
                left: a.sidebar.offset().left + parseInt(a.sidebar.css("padding-left")) - v + "px",
                top: "0px"
              });
            } else if ("absolute" == d) {
              var x = {};
              "absolute" != a.stickySidebar.css("position") && (x.position = "absolute", x.transform = "translateY(" + (r + y - a.sidebar.offset().top - a.stickySidebarPaddingTop - a.stickySidebarPaddingBottom) + "px)", x.top = "0px"), x.width = n(a.stickySidebar) + "px", x.left = "", a.stickySidebar.css(x);
            } else "static" == d && e();
            "static" != d && 1 == a.options.updateSidebarHeight && a.sidebar.css({
              "min-height": a.stickySidebar.outerHeight() + a.stickySidebar.offset().top - a.sidebar.offset().top + a.paddingBottom
            }), a.previousScrollTop = r;
          }
        }, a.onScroll(a), i(document).on("scroll." + a.options.namespace, function (i) {
          return function () {
            i.onScroll(i);
          };
        }(a)), i(window).on("resize." + a.options.namespace, function (i) {
          return function () {
            i.stickySidebar.css({
              position: "static"
            }), i.onScroll(i);
          };
        }(a)), "undefined" != typeof ResizeSensor && new ResizeSensor(a.stickySidebar[0], function (i) {
          return function () {
            i.onScroll(i);
          };
        }(a));
      });
    }
    function n(i) {
      var t;
      try {
        t = i[0].getBoundingClientRect().width;
      } catch (i) {}
      return "undefined" == typeof t && (t = i.width()), t;
    }
    var s = {
      containerSelector: "",
      additionalMarginTop: 0,
      additionalMarginBottom: 0,
      updateSidebarHeight: !0,
      minWidth: 0,
      disableOnResponsiveLayouts: !0,
      sidebarBehavior: "modern",
      defaultPosition: "relative",
      namespace: "TSS"
    };
    return t = i.extend(s, t), t.additionalMarginTop = parseInt(t.additionalMarginTop) || 0, t.additionalMarginBottom = parseInt(t.additionalMarginBottom) || 0, e(t, this), this;
  };
}(jQuery);

/* Lazy Load XT 1.1.0 | MIT License */
!function (a, b, c, d) {
  function e(a, b) {
    return a[b] === d ? t[b] : a[b];
  }
  function f() {
    var a = b.pageYOffset;
    return a === d ? r.scrollTop : a;
  }
  function g(a, b) {
    var c = t["on" + a];
    c && (w(c) ? c.call(b[0]) : (c.addClass && b.addClass(c.addClass), c.removeClass && b.removeClass(c.removeClass))), b.trigger("lazy" + a, [b]), k();
  }
  function h(b) {
    g(b.type, a(this).off(p, h));
  }
  function i(c) {
    if (z.length) {
      c = c || t.forceLoad, A = 1 / 0;
      var d,
        e,
        i = f(),
        j = b.innerHeight || r.clientHeight,
        k = b.innerWidth || r.clientWidth;
      for (d = 0, e = z.length; e > d; d++) {
        var l,
          m = z[d],
          q = m[0],
          s = m[n],
          u = !1,
          v = c || y(q, o) < 0;
        if (a.contains(r, q)) {
          if (c || !s.visibleOnly || q.offsetWidth || q.offsetHeight) {
            if (!v) {
              var x = q.getBoundingClientRect(),
                B = s.edgeX,
                C = s.edgeY;
              l = x.top + i - C - j, v = i >= l && x.bottom > -C && x.left <= k + B && x.right > -B;
            }
            if (v) {
              m.on(p, h), g("show", m);
              var D = s.srcAttr,
                E = w(D) ? D(m) : q.getAttribute(D);
              E && (q.src = E), u = !0;
            } else A > l && (A = l);
          }
        } else u = !0;
        u && (y(q, o, 0), z.splice(d--, 1), e--);
      }
      e || g("complete", a(r));
    }
  }
  function j() {
    B > 1 ? (B = 1, i(), setTimeout(j, t.throttle)) : B = 0;
  }
  function k(a) {
    z.length && (a && "scroll" === a.type && a.currentTarget === b && A >= f() || (B || setTimeout(j, 0), B = 2));
  }
  function l() {
    v.lazyLoadXT();
  }
  function m() {
    i(!0);
  }
  var n = "lazyLoadXT",
    o = "lazied",
    p = "load error",
    q = "lazy-hidden",
    r = c.documentElement || c.body,
    s = b.onscroll === d || !!b.operamini || !r.getBoundingClientRect,
    t = {
      autoInit: !0,
      selector: "img[data-src]",
      blankImage: "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7",
      throttle: 99,
      forceLoad: s,
      loadEvent: "pageshow",
      updateEvent: "load orientationchange resize scroll touchmove focus",
      forceEvent: "lazyloadall",
      oninit: {
        removeClass: "lazy"
      },
      onshow: {
        addClass: q
      },
      onload: {
        removeClass: q,
        addClass: "lazy-loaded"
      },
      onerror: {
        removeClass: q
      },
      checkDuplicates: !0
    },
    u = {
      srcAttr: "data-src",
      edgeX: 0,
      edgeY: 0,
      visibleOnly: !0
    },
    v = a(b),
    w = a.isFunction,
    x = a.extend,
    y = a.data || function (b, c) {
      return a(b).data(c);
    },
    z = [],
    A = 0,
    B = 0;
  a[n] = x(t, u, a[n]), a.fn[n] = function (c) {
    c = c || {};
    var d,
      f = e(c, "blankImage"),
      h = e(c, "checkDuplicates"),
      i = e(c, "scrollContainer"),
      j = e(c, "show"),
      l = {};
    a(i).on("scroll", k);
    for (d in u) l[d] = e(c, d);
    return this.each(function (d, e) {
      if (e === b) a(t.selector).lazyLoadXT(c);else {
        var i = h && y(e, o),
          m = a(e).data(o, j ? -1 : 1);
        if (i) return void k();
        f && "IMG" === e.tagName && !e.src && (e.src = f), m[n] = x({}, l), g("init", m), z.push(m), k();
      }
    });
  }, a(c).ready(function () {
    g("start", v), v.on(t.updateEvent, k).on(t.forceEvent, m), a(c).on(t.updateEvent, k), t.autoInit && (v.on(t.loadEvent, l), l());
  });
}(window.jQuery || window.Zepto || window.$, window, document);
/*!
 * jQuery blockUI plugin
 * Version 2.70.0-2014.11.23
 * Requires jQuery v1.7 or later
 *
 * Examples at: http://malsup.com/jquery/block/
 * Copyright (c) 2007-2013 M. Alsup
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 * Thanks to Amir-Hossein Sobhi for some excellent contributions!
 */

;
(function () {
  /*jshint eqeqeq:false curly:false latedef:false */
  "use strict";

  function setup($) {
    $.fn._fadeIn = $.fn.fadeIn;
    var noOp = $.noop || function () {};

    // this bit is to ensure we don't call setExpression when we shouldn't (with extra muscle to handle
    // confusing userAgent strings on Vista)
    var msie = /MSIE/.test(navigator.userAgent);
    var ie6 = /MSIE 6.0/.test(navigator.userAgent) && !/MSIE 8.0/.test(navigator.userAgent);
    var mode = document.documentMode || 0;
    var setExpr = $.isFunction(document.createElement('div').style.setExpression);

    // global $ methods for blocking/unblocking the entire page
    $.blockUI = function (opts) {
      install(window, opts);
    };
    $.unblockUI = function (opts) {
      remove(window, opts);
    };

    // convenience method for quick growl-like notifications  (http://www.google.com/search?q=growl)
    $.growlUI = function (title, message, timeout, onClose) {
      var $m = $('<div class="growlUI"></div>');
      if (title) $m.append('<h1>' + title + '</h1>');
      if (message) $m.append('<h2>' + message + '</h2>');
      if (timeout === undefined) timeout = 3000;

      // Added by konapun: Set timeout to 30 seconds if this growl is moused over, like normal toast notifications
      var callBlock = function callBlock(opts) {
        opts = opts || {};
        $.blockUI({
          message: $m,
          fadeIn: typeof opts.fadeIn !== 'undefined' ? opts.fadeIn : 700,
          fadeOut: typeof opts.fadeOut !== 'undefined' ? opts.fadeOut : 1000,
          timeout: typeof opts.timeout !== 'undefined' ? opts.timeout : timeout,
          centerY: false,
          showOverlay: false,
          onUnblock: onClose,
          css: $.blockUI.defaults.growlCSS
        });
      };
      callBlock();
      var nonmousedOpacity = $m.css('opacity');
      $m.mouseover(function () {
        callBlock({
          fadeIn: 0,
          timeout: 30000
        });
        var displayBlock = $('.blockMsg');
        displayBlock.stop(); // cancel fadeout if it has started
        displayBlock.fadeTo(300, 1); // make it easier to read the message by removing transparency
      }).mouseout(function () {
        $('.blockMsg').fadeOut(1000);
      });
      // End konapun additions
    };

    // plugin method for blocking element content
    $.fn.block = function (opts) {
      if (this[0] === window) {
        $.blockUI(opts);
        return this;
      }
      var fullOpts = $.extend({}, $.blockUI.defaults, opts || {});
      this.each(function () {
        var $el = $(this);
        if (fullOpts.ignoreIfBlocked && $el.data('blockUI.isBlocked')) return;
        $el.unblock({
          fadeOut: 0
        });
      });
      return this.each(function () {
        if ($.css(this, 'position') == 'static') {
          this.style.position = 'relative';
          $(this).data('blockUI.static', true);
        }
        this.style.zoom = 1; // force 'hasLayout' in ie
        install(this, opts);
      });
    };

    // plugin method for unblocking element content
    $.fn.unblock = function (opts) {
      if (this[0] === window) {
        $.unblockUI(opts);
        return this;
      }
      return this.each(function () {
        remove(this, opts);
      });
    };
    $.blockUI.version = 2.70; // 2nd generation blocking at no extra cost!

    // override these in your code to change the default behavior and style
    $.blockUI.defaults = {
      // message displayed when blocking (use null for no message)
      message: '<h1>Please wait...</h1>',
      title: null,
      // title string; only used when theme == true
      draggable: true,
      // only used when theme == true (requires jquery-ui.js to be loaded)

      theme: false,
      // set to true to use with jQuery UI themes

      // styles for the message when blocking; if you wish to disable
      // these and use an external stylesheet then do this in your code:
      // $.blockUI.defaults.css = {};
      css: {
        padding: 0,
        margin: 0,
        width: '30%',
        top: '40%',
        left: '35%',
        textAlign: 'center',
        color: '#000',
        border: '3px solid #aaa',
        backgroundColor: '#fff',
        cursor: 'wait'
      },
      // minimal style set used when themes are used
      themedCSS: {
        width: '30%',
        top: '40%',
        left: '35%'
      },
      // styles for the overlay
      overlayCSS: {
        backgroundColor: '#000',
        opacity: 0.6,
        cursor: 'wait'
      },
      // style to replace wait cursor before unblocking to correct issue
      // of lingering wait cursor
      cursorReset: 'default',
      // styles applied when using $.growlUI
      growlCSS: {
        width: '350px',
        top: '10px',
        left: '',
        right: '10px',
        border: 'none',
        padding: '5px',
        opacity: 0.6,
        cursor: 'default',
        color: '#fff',
        backgroundColor: '#000',
        '-webkit-border-radius': '10px',
        '-moz-border-radius': '10px',
        'border-radius': '10px'
      },
      // IE issues: 'about:blank' fails on HTTPS and javascript:false is s-l-o-w
      // (hat tip to Jorge H. N. de Vasconcelos)
      /*jshint scripturl:true */
      iframeSrc: /^https/i.test(window.location.href || '') ? 'javascript:false' : 'about:blank',
      // force usage of iframe in non-IE browsers (handy for blocking applets)
      forceIframe: false,
      // z-index for the blocking overlay
      baseZ: 1000,
      // set these to true to have the message automatically centered
      centerX: true,
      // <-- only effects element blocking (page block controlled via css above)
      centerY: true,
      // allow body element to be stetched in ie6; this makes blocking look better
      // on "short" pages.  disable if you wish to prevent changes to the body height
      allowBodyStretch: true,
      // enable if you want key and mouse events to be disabled for content that is blocked
      bindEvents: true,
      // be default blockUI will supress tab navigation from leaving blocking content
      // (if bindEvents is true)
      constrainTabKey: true,
      // fadeIn time in millis; set to 0 to disable fadeIn on block
      fadeIn: 200,
      // fadeOut time in millis; set to 0 to disable fadeOut on unblock
      fadeOut: 400,
      // time in millis to wait before auto-unblocking; set to 0 to disable auto-unblock
      timeout: 0,
      // disable if you don't want to show the overlay
      showOverlay: true,
      // if true, focus will be placed in the first available input field when
      // page blocking
      focusInput: true,
      // elements that can receive focus
      focusableElements: ':input:enabled:visible',
      // suppresses the use of overlay styles on FF/Linux (due to performance issues with opacity)
      // no longer needed in 2012
      // applyPlatformOpacityRules: true,

      // callback method invoked when fadeIn has completed and blocking message is visible
      onBlock: null,
      // callback method invoked when unblocking has completed; the callback is
      // passed the element that has been unblocked (which is the window object for page
      // blocks) and the options that were passed to the unblock call:
      //	onUnblock(element, options)
      onUnblock: null,
      // callback method invoked when the overlay area is clicked.
      // setting this will turn the cursor to a pointer, otherwise cursor defined in overlayCss will be used.
      onOverlayClick: null,
      // don't ask; if you really must know: http://groups.google.com/group/jquery-en/browse_thread/thread/36640a8730503595/2f6a79a77a78e493#2f6a79a77a78e493
      quirksmodeOffsetHack: 4,
      // class name of the message block
      blockMsgClass: 'blockMsg',
      // if it is already blocked, then ignore it (don't unblock and reblock)
      ignoreIfBlocked: false
    };

    // private data and functions follow...

    var pageBlock = null;
    var pageBlockEls = [];
    function install(el, opts) {
      var css, themedCSS;
      var full = el == window;
      var msg = opts && opts.message !== undefined ? opts.message : undefined;
      opts = $.extend({}, $.blockUI.defaults, opts || {});
      if (opts.ignoreIfBlocked && $(el).data('blockUI.isBlocked')) return;
      opts.overlayCSS = $.extend({}, $.blockUI.defaults.overlayCSS, opts.overlayCSS || {});
      css = $.extend({}, $.blockUI.defaults.css, opts.css || {});
      if (opts.onOverlayClick) opts.overlayCSS.cursor = 'pointer';
      themedCSS = $.extend({}, $.blockUI.defaults.themedCSS, opts.themedCSS || {});
      msg = msg === undefined ? opts.message : msg;

      // remove the current block (if there is one)
      if (full && pageBlock) remove(window, {
        fadeOut: 0
      });

      // if an existing element is being used as the blocking content then we capture
      // its current place in the DOM (and current display style) so we can restore
      // it when we unblock
      if (msg && typeof msg != 'string' && (msg.parentNode || msg.jquery)) {
        var node = msg.jquery ? msg[0] : msg;
        var data = {};
        $(el).data('blockUI.history', data);
        data.el = node;
        data.parent = node.parentNode;
        data.display = node.style.display;
        data.position = node.style.position;
        if (data.parent) data.parent.removeChild(node);
      }
      $(el).data('blockUI.onUnblock', opts.onUnblock);
      var z = opts.baseZ;

      // blockUI uses 3 layers for blocking, for simplicity they are all used on every platform;
      // layer1 is the iframe layer which is used to supress bleed through of underlying content
      // layer2 is the overlay layer which has opacity and a wait cursor (by default)
      // layer3 is the message content that is displayed while blocking
      var lyr1, lyr2, lyr3, s;
      if (msie || opts.forceIframe) lyr1 = $('<iframe class="blockUI" style="z-index:' + z++ + ';display:none;border:none;margin:0;padding:0;position:absolute;width:100%;height:100%;top:0;left:0" src="' + opts.iframeSrc + '"></iframe>');else lyr1 = $('<div class="blockUI" style="display:none"></div>');
      if (opts.theme) lyr2 = $('<div class="blockUI blockOverlay ui-widget-overlay" style="z-index:' + z++ + ';display:none"></div>');else lyr2 = $('<div class="blockUI blockOverlay" style="z-index:' + z++ + ';display:none;border:none;margin:0;padding:0;width:100%;height:100%;top:0;left:0"></div>');
      if (opts.theme && full) {
        s = '<div class="blockUI ' + opts.blockMsgClass + ' blockPage ui-dialog ui-widget ui-corner-all" style="z-index:' + (z + 10) + ';display:none;position:fixed">';
        if (opts.title) {
          s += '<div class="ui-widget-header ui-dialog-titlebar ui-corner-all blockTitle">' + (opts.title || '&nbsp;') + '</div>';
        }
        s += '<div class="ui-widget-content ui-dialog-content"></div>';
        s += '</div>';
      } else if (opts.theme) {
        s = '<div class="blockUI ' + opts.blockMsgClass + ' blockElement ui-dialog ui-widget ui-corner-all" style="z-index:' + (z + 10) + ';display:none;position:absolute">';
        if (opts.title) {
          s += '<div class="ui-widget-header ui-dialog-titlebar ui-corner-all blockTitle">' + (opts.title || '&nbsp;') + '</div>';
        }
        s += '<div class="ui-widget-content ui-dialog-content"></div>';
        s += '</div>';
      } else if (full) {
        s = '<div class="blockUI ' + opts.blockMsgClass + ' blockPage" style="z-index:' + (z + 10) + ';display:none;position:fixed"></div>';
      } else {
        s = '<div class="blockUI ' + opts.blockMsgClass + ' blockElement" style="z-index:' + (z + 10) + ';display:none;position:absolute"></div>';
      }
      lyr3 = $(s);

      // if we have a message, style it
      if (msg) {
        if (opts.theme) {
          lyr3.css(themedCSS);
          lyr3.addClass('ui-widget-content');
        } else lyr3.css(css);
      }

      // style the overlay
      if (!opts.theme /*&& (!opts.applyPlatformOpacityRules)*/) lyr2.css(opts.overlayCSS);
      lyr2.css('position', full ? 'fixed' : 'absolute');

      // make iframe layer transparent in IE
      if (msie || opts.forceIframe) lyr1.css('opacity', 0.0);

      //$([lyr1[0],lyr2[0],lyr3[0]]).appendTo(full ? 'body' : el);
      var layers = [lyr1, lyr2, lyr3],
        $par = full ? $('body') : $(el);
      $.each(layers, function () {
        this.appendTo($par);
      });
      if (opts.theme && opts.draggable && $.fn.draggable) {
        lyr3.draggable({
          handle: '.ui-dialog-titlebar',
          cancel: 'li'
        });
      }

      // ie7 must use absolute positioning in quirks mode and to account for activex issues (when scrolling)
      var expr = setExpr && (!$.support.boxModel || $('object,embed', full ? null : el).length > 0);
      if (ie6 || expr) {
        // give body 100% height
        if (full && opts.allowBodyStretch && $.support.boxModel) $('html,body').css('height', '100%');

        // fix ie6 issue when blocked element has a border width
        if ((ie6 || !$.support.boxModel) && !full) {
          var t = sz(el, 'borderTopWidth'),
            l = sz(el, 'borderLeftWidth');
          var fixT = t ? '(0 - ' + t + ')' : 0;
          var fixL = l ? '(0 - ' + l + ')' : 0;
        }

        // simulate fixed position
        $.each(layers, function (i, o) {
          var s = o[0].style;
          s.position = 'absolute';
          if (i < 2) {
            if (full) s.setExpression('height', 'Math.max(document.body.scrollHeight, document.body.offsetHeight) - (jQuery.support.boxModel?0:' + opts.quirksmodeOffsetHack + ') + "px"');else s.setExpression('height', 'this.parentNode.offsetHeight + "px"');
            if (full) s.setExpression('width', 'jQuery.support.boxModel && document.documentElement.clientWidth || document.body.clientWidth + "px"');else s.setExpression('width', 'this.parentNode.offsetWidth + "px"');
            if (fixL) s.setExpression('left', fixL);
            if (fixT) s.setExpression('top', fixT);
          } else if (opts.centerY) {
            if (full) s.setExpression('top', '(document.documentElement.clientHeight || document.body.clientHeight) / 2 - (this.offsetHeight / 2) + (blah = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"');
            s.marginTop = 0;
          } else if (!opts.centerY && full) {
            var top = opts.css && opts.css.top ? parseInt(opts.css.top, 10) : 0;
            var expression = '((document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + ' + top + ') + "px"';
            s.setExpression('top', expression);
          }
        });
      }

      // show the message
      if (msg) {
        if (opts.theme) lyr3.find('.ui-widget-content').append(msg);else lyr3.append(msg);
        if (msg.jquery || msg.nodeType) $(msg).show();
      }
      if ((msie || opts.forceIframe) && opts.showOverlay) lyr1.show(); // opacity is zero
      if (opts.fadeIn) {
        var cb = opts.onBlock ? opts.onBlock : noOp;
        var cb1 = opts.showOverlay && !msg ? cb : noOp;
        var cb2 = msg ? cb : noOp;
        if (opts.showOverlay) lyr2._fadeIn(opts.fadeIn, cb1);
        if (msg) lyr3._fadeIn(opts.fadeIn, cb2);
      } else {
        if (opts.showOverlay) lyr2.show();
        if (msg) lyr3.show();
        if (opts.onBlock) opts.onBlock.bind(lyr3)();
      }

      // bind key and mouse events
      bind(1, el, opts);
      if (full) {
        pageBlock = lyr3[0];
        pageBlockEls = $(opts.focusableElements, pageBlock);
        if (opts.focusInput) setTimeout(focus, 20);
      } else center(lyr3[0], opts.centerX, opts.centerY);
      if (opts.timeout) {
        // auto-unblock
        var to = setTimeout(function () {
          if (full) $.unblockUI(opts);else $(el).unblock(opts);
        }, opts.timeout);
        $(el).data('blockUI.timeout', to);
      }
    }

    // remove the block
    function remove(el, opts) {
      var count;
      var full = el == window;
      var $el = $(el);
      var data = $el.data('blockUI.history');
      var to = $el.data('blockUI.timeout');
      if (to) {
        clearTimeout(to);
        $el.removeData('blockUI.timeout');
      }
      opts = $.extend({}, $.blockUI.defaults, opts || {});
      bind(0, el, opts); // unbind events

      if (opts.onUnblock === null) {
        opts.onUnblock = $el.data('blockUI.onUnblock');
        $el.removeData('blockUI.onUnblock');
      }
      var els;
      if (full)
        // crazy selector to handle odd field errors in ie6/7
        els = $('body').children().filter('.blockUI').add('body > .blockUI');else els = $el.find('>.blockUI');

      // fix cursor issue
      if (opts.cursorReset) {
        if (els.length > 1) els[1].style.cursor = opts.cursorReset;
        if (els.length > 2) els[2].style.cursor = opts.cursorReset;
      }
      if (full) pageBlock = pageBlockEls = null;
      if (opts.fadeOut) {
        count = els.length;
        els.stop().fadeOut(opts.fadeOut, function () {
          if (--count === 0) reset(els, data, opts, el);
        });
      } else reset(els, data, opts, el);
    }

    // move blocking element back into the DOM where it started
    function reset(els, data, opts, el) {
      var $el = $(el);
      if ($el.data('blockUI.isBlocked')) return;
      els.each(function (i, o) {
        // remove via DOM calls so we don't lose event handlers
        if (this.parentNode) this.parentNode.removeChild(this);
      });
      if (data && data.el) {
        data.el.style.display = data.display;
        data.el.style.position = data.position;
        data.el.style.cursor = 'default'; // #59
        if (data.parent) data.parent.appendChild(data.el);
        $el.removeData('blockUI.history');
      }
      if ($el.data('blockUI.static')) {
        $el.css('position', 'static'); // #22
      }

      if (typeof opts.onUnblock == 'function') opts.onUnblock(el, opts);

      // fix issue in Safari 6 where block artifacts remain until reflow
      var body = $(document.body),
        w = body.width(),
        cssW = body[0].style.width;
      body.width(w - 1).width(w);
      body[0].style.width = cssW;
    }

    // bind/unbind the handler
    function bind(b, el, opts) {
      var full = el == window,
        $el = $(el);

      // don't bother unbinding if there is nothing to unbind
      if (!b && (full && !pageBlock || !full && !$el.data('blockUI.isBlocked'))) return;
      $el.data('blockUI.isBlocked', b);

      // don't bind events when overlay is not in use or if bindEvents is false
      if (!full || !opts.bindEvents || b && !opts.showOverlay) return;

      // bind anchors and inputs for mouse and key events
      var events = 'mousedown mouseup keydown keypress keyup touchstart touchend touchmove';
      if (b) $(document).bind(events, opts, handler);else $(document).unbind(events, handler);

      // former impl...
      //		var $e = $('a,:input');
      //		b ? $e.bind(events, opts, handler) : $e.unbind(events, handler);
    }

    // event handler to suppress keyboard/mouse events when blocking
    function handler(e) {
      // allow tab navigation (conditionally)
      if (e.type === 'keydown' && e.keyCode && e.keyCode == 9) {
        if (pageBlock && e.data.constrainTabKey) {
          var els = pageBlockEls;
          var fwd = !e.shiftKey && e.target === els[els.length - 1];
          var back = e.shiftKey && e.target === els[0];
          if (fwd || back) {
            setTimeout(function () {
              focus(back);
            }, 10);
            return false;
          }
        }
      }
      var opts = e.data;
      var target = $(e.target);
      if (target.hasClass('blockOverlay') && opts.onOverlayClick) opts.onOverlayClick(e);

      // allow events within the message content
      if (target.parents('div.' + opts.blockMsgClass).length > 0) return true;

      // allow events for content that is not being blocked
      return target.parents().children().filter('div.blockUI').length === 0;
    }
    function focus(back) {
      if (!pageBlockEls) return;
      var e = pageBlockEls[back === true ? pageBlockEls.length - 1 : 0];
      if (e) e.focus();
    }
    function center(el, x, y) {
      var p = el.parentNode,
        s = el.style;
      var l = (p.offsetWidth - el.offsetWidth) / 2 - sz(p, 'borderLeftWidth');
      var t = (p.offsetHeight - el.offsetHeight) / 2 - sz(p, 'borderTopWidth');
      if (x) s.left = l > 0 ? l + 'px' : '0';
      if (y) s.top = t > 0 ? t + 'px' : '0';
    }
    function sz(el, p) {
      return parseInt($.css(el, p), 10) || 0;
    }
  }

  /*global define:true */
  if (typeof define === 'function' && define.amd && define.amd.jQuery) {
    define(['jquery'], setup);
  } else {
    setup(jQuery);
  }
})();
!function (t, e) {
  "object" == (typeof exports === "undefined" ? "undefined" : _typeof(exports)) && "undefined" != typeof module ? module.exports = e() : "function" == typeof define && define.amd ? define(e) : t.Sweetalert2 = e();
}(this, function () {
  "use strict";

  function f(t) {
    return (f = "function" == typeof Symbol && "symbol" == _typeof(Symbol.iterator) ? function (t) {
      return _typeof(t);
    } : function (t) {
      return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : _typeof(t);
    })(t);
  }
  function o(t, e) {
    if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function");
  }
  function i(t, e) {
    for (var n = 0; n < e.length; n++) {
      var o = e[n];
      o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(t, o.key, o);
    }
  }
  function r(t, e, n) {
    return e && i(t.prototype, e), n && i(t, n), t;
  }
  function a() {
    return (a = Object.assign || function (t) {
      for (var e = 1; e < arguments.length; e++) {
        var n = arguments[e];
        for (var o in n) Object.prototype.hasOwnProperty.call(n, o) && (t[o] = n[o]);
      }
      return t;
    }).apply(this, arguments);
  }
  function s(t) {
    return (s = Object.setPrototypeOf ? Object.getPrototypeOf : function (t) {
      return t.__proto__ || Object.getPrototypeOf(t);
    })(t);
  }
  function u(t, e) {
    return (u = Object.setPrototypeOf || function (t, e) {
      return t.__proto__ = e, t;
    })(t, e);
  }
  function c(t, e, n) {
    return (c = function () {
      if ("undefined" == typeof Reflect || !Reflect.construct) return !1;
      if (Reflect.construct.sham) return !1;
      if ("function" == typeof Proxy) return !0;
      try {
        return Date.prototype.toString.call(Reflect.construct(Date, [], function () {})), !0;
      } catch (t) {
        return !1;
      }
    }() ? Reflect.construct : function (t, e, n) {
      var o = [null];
      o.push.apply(o, e);
      var i = new (Function.bind.apply(t, o))();
      return n && u(i, n.prototype), i;
    }).apply(null, arguments);
  }
  function l(t, e) {
    return !e || "object" != _typeof(e) && "function" != typeof e ? function (t) {
      if (void 0 === t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
      return t;
    }(t) : e;
  }
  function d(t, e, n) {
    return (d = "undefined" != typeof Reflect && Reflect.get ? Reflect.get : function (t, e, n) {
      var o = function (t, e) {
        for (; !Object.prototype.hasOwnProperty.call(t, e) && null !== (t = s(t)););
        return t;
      }(t, e);
      if (o) {
        var i = Object.getOwnPropertyDescriptor(o, e);
        return i.get ? i.get.call(n) : i.value;
      }
    })(t, e, n || t);
  }
  function p(e) {
    return Object.keys(e).map(function (t) {
      return e[t];
    });
  }
  function m(t) {
    return Array.prototype.slice.call(t);
  }
  function g(t) {
    console.error("".concat(e, " ").concat(t));
  }
  function h(t, e) {
    !function (t) {
      -1 === n.indexOf(t) && (n.push(t), y(t));
    }('"'.concat(t, '" is deprecated and will be removed in the next major release. Please use "').concat(e, '" instead.'));
  }
  function v(t) {
    return t && Promise.resolve(t) === t;
  }
  function t(t) {
    var e = {};
    for (var n in t) e[t[n]] = "swal2-" + t[n];
    return e;
  }
  function b(e, t, n) {
    m(e.classList).forEach(function (t) {
      -1 === p(k).indexOf(t) && -1 === p(B).indexOf(t) && e.classList.remove(t);
    }), t && t[n] && nt(e, t[n]);
  }
  var e = "SweetAlert2:",
    y = function y(t) {
      console.warn("".concat(e, " ").concat(t));
    },
    n = [],
    w = function w(t) {
      return "function" == typeof t ? t() : t;
    },
    C = Object.freeze({
      cancel: "cancel",
      backdrop: "backdrop",
      close: "close",
      esc: "esc",
      timer: "timer"
    }),
    k = t(["container", "shown", "height-auto", "iosfix", "popup", "modal", "no-backdrop", "toast", "toast-shown", "toast-column", "fade", "show", "hide", "noanimation", "close", "title", "header", "content", "actions", "confirm", "cancel", "footer", "icon", "image", "input", "file", "range", "select", "radio", "checkbox", "label", "textarea", "inputerror", "validation-message", "progress-steps", "active-progress-step", "progress-step", "progress-step-line", "loading", "styled", "top", "top-start", "top-end", "top-left", "top-right", "center", "center-start", "center-end", "center-left", "center-right", "bottom", "bottom-start", "bottom-end", "bottom-left", "bottom-right", "grow-row", "grow-column", "grow-fullscreen", "rtl"]),
    B = t(["success", "warning", "info", "question", "error"]),
    x = {
      previousBodyPadding: null
    },
    S = function S(t, e) {
      return t.classList.contains(e);
    };
  function P(t, e) {
    if (!e) return null;
    switch (e) {
      case "select":
      case "textarea":
      case "file":
        return it(t, k[e]);
      case "checkbox":
        return t.querySelector(".".concat(k.checkbox, " input"));
      case "radio":
        return t.querySelector(".".concat(k.radio, " input:checked")) || t.querySelector(".".concat(k.radio, " input:first-child"));
      case "range":
        return t.querySelector(".".concat(k.range, " input"));
      default:
        return it(t, k.input);
    }
  }
  function A(t) {
    if (t.focus(), "file" !== t.type) {
      var e = t.value;
      t.value = "", t.value = e;
    }
  }
  function L(t, e, n) {
    t && e && ("string" == typeof e && (e = e.split(/\s+/).filter(Boolean)), e.forEach(function (e) {
      t.forEach ? t.forEach(function (t) {
        n ? t.classList.add(e) : t.classList.remove(e);
      }) : n ? t.classList.add(e) : t.classList.remove(e);
    }));
  }
  function E(t, e, n) {
    n || 0 === parseInt(n) ? t.style[e] = "number" == typeof n ? n + "px" : n : t.style.removeProperty(e);
  }
  function T(t, e) {
    var n = 1 < arguments.length && void 0 !== e ? e : "flex";
    t.style.opacity = "", t.style.display = n;
  }
  function O(t) {
    t.style.opacity = "", t.style.display = "none";
  }
  function M(t, e, n) {
    e ? T(t, n) : O(t);
  }
  function V(t) {
    return !(!t || !(t.offsetWidth || t.offsetHeight || t.getClientRects().length));
  }
  function j(t) {
    var e = window.getComputedStyle(t),
      n = parseFloat(e.getPropertyValue("animation-duration") || "0"),
      o = parseFloat(e.getPropertyValue("transition-duration") || "0");
    return 0 < n || 0 < o;
  }
  function q() {
    return document.body.querySelector("." + k.container);
  }
  function H(t) {
    var e = q();
    return e ? e.querySelector(t) : null;
  }
  function I(t) {
    return H("." + t);
  }
  function R() {
    var t = rt();
    return m(t.querySelectorAll("." + k.icon));
  }
  function N() {
    var t = R().filter(function (t) {
      return V(t);
    });
    return t.length ? t[0] : null;
  }
  function D() {
    return I(k.title);
  }
  function U() {
    return I(k.content);
  }
  function _() {
    return I(k.image);
  }
  function z() {
    return I(k["progress-steps"]);
  }
  function W() {
    return I(k["validation-message"]);
  }
  function K() {
    return H("." + k.actions + " ." + k.confirm);
  }
  function F() {
    return H("." + k.actions + " ." + k.cancel);
  }
  function Z() {
    return I(k.actions);
  }
  function Q() {
    return I(k.header);
  }
  function Y() {
    return I(k.footer);
  }
  function $() {
    return I(k.close);
  }
  function J() {
    var t = m(rt().querySelectorAll('[tabindex]:not([tabindex="-1"]):not([tabindex="0"])')).sort(function (t, e) {
        return t = parseInt(t.getAttribute("tabindex")), (e = parseInt(e.getAttribute("tabindex"))) < t ? 1 : t < e ? -1 : 0;
      }),
      e = m(rt().querySelectorAll('a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex="0"], [contenteditable], audio[controls], video[controls]')).filter(function (t) {
        return "-1" !== t.getAttribute("tabindex");
      });
    return function (t) {
      for (var e = [], n = 0; n < t.length; n++) -1 === e.indexOf(t[n]) && e.push(t[n]);
      return e;
    }(t.concat(e)).filter(function (t) {
      return V(t);
    });
  }
  function X() {
    return "undefined" == typeof window || "undefined" == typeof document;
  }
  function G(t) {
    ce.isVisible() && et !== t.target.value && ce.resetValidationMessage(), et = t.target.value;
  }
  function tt(t, e) {
    t instanceof HTMLElement ? e.appendChild(t) : "object" === f(t) ? lt(e, t) : t && (e.innerHTML = t);
  }
  var et,
    nt = function nt(t, e) {
      L(t, e, !0);
    },
    ot = function ot(t, e) {
      L(t, e, !1);
    },
    it = function it(t, e) {
      for (var n = 0; n < t.childNodes.length; n++) if (S(t.childNodes[n], e)) return t.childNodes[n];
    },
    rt = function rt() {
      return I(k.popup);
    },
    at = function at() {
      return !st() && !document.body.classList.contains(k["no-backdrop"]);
    },
    st = function st() {
      return document.body.classList.contains(k["toast-shown"]);
    },
    ut = '\n <div aria-labelledby="'.concat(k.title, '" aria-describedby="').concat(k.content, '" class="').concat(k.popup, '" tabindex="-1">\n   <div class="').concat(k.header, '">\n     <ul class="').concat(k["progress-steps"], '"></ul>\n     <div class="').concat(k.icon, " ").concat(B.error, '">\n       <span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span>\n     </div>\n     <div class="').concat(k.icon, " ").concat(B.question, '"></div>\n     <div class="').concat(k.icon, " ").concat(B.warning, '"></div>\n     <div class="').concat(k.icon, " ").concat(B.info, '"></div>\n     <div class="').concat(k.icon, " ").concat(B.success, '">\n       <div class="swal2-success-circular-line-left"></div>\n       <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>\n       <div class="swal2-success-ring"></div> <div class="swal2-success-fix"></div>\n       <div class="swal2-success-circular-line-right"></div>\n     </div>\n     <img class="').concat(k.image, '" />\n     <h2 class="').concat(k.title, '" id="').concat(k.title, '"></h2>\n     <button type="button" class="').concat(k.close, '">&times;</button>\n   </div>\n   <div class="').concat(k.content, '">\n     <div id="').concat(k.content, '"></div>\n     <input class="').concat(k.input, '" />\n     <input type="file" class="').concat(k.file, '" />\n     <div class="').concat(k.range, '">\n       <input type="range" />\n       <output></output>\n     </div>\n     <select class="').concat(k.select, '"></select>\n     <div class="').concat(k.radio, '"></div>\n     <label for="').concat(k.checkbox, '" class="').concat(k.checkbox, '">\n       <input type="checkbox" />\n       <span class="').concat(k.label, '"></span>\n     </label>\n     <textarea class="').concat(k.textarea, '"></textarea>\n     <div class="').concat(k["validation-message"], '" id="').concat(k["validation-message"], '"></div>\n   </div>\n   <div class="').concat(k.actions, '">\n     <button type="button" class="').concat(k.confirm, '">OK</button>\n     <button type="button" class="').concat(k.cancel, '">Cancel</button>\n   </div>\n   <div class="').concat(k.footer, '">\n   </div>\n </div>\n').replace(/(^|\n)\s*/g, ""),
    ct = function ct(t) {
      if (function () {
        var t = q();
        t && (t.parentNode.removeChild(t), ot([document.documentElement, document.body], [k["no-backdrop"], k["toast-shown"], k["has-column"]]));
      }(), X()) g("SweetAlert2 requires document to initialize");else {
        var e = document.createElement("div");
        e.className = k.container, e.innerHTML = ut;
        var n = function (t) {
          return "string" == typeof t ? document.querySelector(t) : t;
        }(t.target);
        n.appendChild(e), function (t) {
          var e = rt();
          e.setAttribute("role", t.toast ? "alert" : "dialog"), e.setAttribute("aria-live", t.toast ? "polite" : "assertive"), t.toast || e.setAttribute("aria-modal", "true");
        }(t), function (t) {
          "rtl" === window.getComputedStyle(t).direction && nt(q(), k.rtl);
        }(n), function () {
          var t = U(),
            e = it(t, k.input),
            n = it(t, k.file),
            o = t.querySelector(".".concat(k.range, " input")),
            i = t.querySelector(".".concat(k.range, " output")),
            r = it(t, k.select),
            a = t.querySelector(".".concat(k.checkbox, " input")),
            s = it(t, k.textarea);
          e.oninput = G, n.onchange = G, r.onchange = G, a.onchange = G, s.oninput = G, o.oninput = function (t) {
            G(t), i.value = o.value;
          }, o.onchange = function (t) {
            G(t), o.nextSibling.value = o.value;
          };
        }();
      }
    },
    lt = function lt(t, e) {
      if (t.innerHTML = "", 0 in e) for (var n = 0; (n in e); n++) t.appendChild(e[n].cloneNode(!0));else t.appendChild(e.cloneNode(!0));
    },
    dt = function () {
      if (X()) return !1;
      var t = document.createElement("div"),
        e = {
          WebkitAnimation: "webkitAnimationEnd",
          OAnimation: "oAnimationEnd oanimationend",
          animation: "animationend"
        };
      for (var n in e) if (e.hasOwnProperty(n) && void 0 !== t.style[n]) return e[n];
      return !1;
    }();
  function pt(t, e, n) {
    M(t, n["showC" + e.substring(1) + "Button"], "inline-block"), t.innerHTML = n[e + "ButtonText"], t.setAttribute("aria-label", n[e + "ButtonAriaLabel"]), t.className = k[e], b(t, n.customClass, e + "Button"), nt(t, n[e + "ButtonClass"]);
  }
  function ft(t, e) {
    var n = Z(),
      o = K(),
      i = F();
    e.showConfirmButton || e.showCancelButton ? T(n) : O(n), b(n, e.customClass, "actions"), pt(o, "confirm", e), pt(i, "cancel", e), e.buttonsStyling ? function (t, e, n) {
      nt([t, e], k.styled), n.confirmButtonColor && (t.style.backgroundColor = n.confirmButtonColor), n.cancelButtonColor && (e.style.backgroundColor = n.cancelButtonColor);
      var o = window.getComputedStyle(t).getPropertyValue("background-color");
      t.style.borderLeftColor = o, t.style.borderRightColor = o;
    }(o, i, e) : (ot([o, i], k.styled), o.style.backgroundColor = o.style.borderLeftColor = o.style.borderRightColor = "", i.style.backgroundColor = i.style.borderLeftColor = i.style.borderRightColor = "");
  }
  function mt(t, e) {
    var n = q();
    n && (function (t, e) {
      "string" == typeof e ? t.style.background = e : e || nt([document.documentElement, document.body], k["no-backdrop"]);
    }(n, e.backdrop), !e.backdrop && e.allowOutsideClick && y('"allowOutsideClick" parameter requires `backdrop` parameter to be set to `true`'), function (t, e) {
      e in k ? nt(t, k[e]) : (y('The "position" parameter is not valid, defaulting to "center"'), nt(t, k.center));
    }(n, e.position), function (t, e) {
      if (e && "string" == typeof e) {
        var n = "grow-" + e;
        n in k && nt(t, k[n]);
      }
    }(n, e.grow), b(n, e.customClass, "container"), e.customContainerClass && nt(n, e.customContainerClass));
  }
  function gt(t, e) {
    t.placeholder && !e.inputPlaceholder || (t.placeholder = e.inputPlaceholder);
  }
  var ht = {
      promise: new WeakMap(),
      innerParams: new WeakMap(),
      domCache: new WeakMap()
    },
    vt = function vt(t, e) {
      var n = P(U(), t);
      if (n) for (var o in function (t) {
        for (var e = 0; e < t.attributes.length; e++) {
          var n = t.attributes[e].name;
          -1 === ["type", "value", "style"].indexOf(n) && t.removeAttribute(n);
        }
      }(n), e) "range" === t && "placeholder" === o || n.setAttribute(o, e[o]);
    },
    bt = function bt(t, e, n) {
      t.className = e, n.inputClass && nt(t, n.inputClass), n.customClass && nt(t, n.customClass.input);
    },
    yt = {};
  yt.text = yt.email = yt.password = yt.number = yt.tel = yt.url = function (t) {
    var e = it(U(), k.input);
    return "string" == typeof t.inputValue || "number" == typeof t.inputValue ? e.value = t.inputValue : v(t.inputValue) || y('Unexpected type of inputValue! Expected "string", "number" or "Promise", got "'.concat(f(t.inputValue), '"')), gt(e, t), e.type = t.input, e;
  }, yt.file = function (t) {
    var e = it(U(), k.file);
    return gt(e, t), e.type = t.input, e;
  }, yt.range = function (t) {
    var e = it(U(), k.range),
      n = e.querySelector("input"),
      o = e.querySelector("output");
    return n.value = t.inputValue, n.type = t.input, o.value = t.inputValue, e;
  }, yt.select = function (t) {
    var e = it(U(), k.select);
    if (e.innerHTML = "", t.inputPlaceholder) {
      var n = document.createElement("option");
      n.innerHTML = t.inputPlaceholder, n.value = "", n.disabled = !0, n.selected = !0, e.appendChild(n);
    }
    return e;
  }, yt.radio = function () {
    var t = it(U(), k.radio);
    return t.innerHTML = "", t;
  }, yt.checkbox = function (t) {
    var e = it(U(), k.checkbox),
      n = P(U(), "checkbox");
    return n.type = "checkbox", n.value = 1, n.id = k.checkbox, n.checked = Boolean(t.inputValue), e.querySelector("span").innerHTML = t.inputPlaceholder, e;
  }, yt.textarea = function (t) {
    var e = it(U(), k.textarea);
    return e.value = t.inputValue, gt(e, t), e;
  };
  function wt(t, e) {
    var n = U().querySelector("#" + k.content);
    e.html ? (tt(e.html, n), T(n, "block")) : e.text ? (n.textContent = e.text, T(n, "block")) : O(n), function (t, e) {
      for (var n = ht.innerParams.get(t), o = !n || e.input !== n.input, i = U(), r = ["input", "file", "range", "select", "radio", "checkbox", "textarea"], a = 0; a < r.length; a++) {
        var s = k[r[a]],
          u = it(i, s);
        vt(r[a], e.inputAttributes), bt(u, s, e), o && O(u);
      }
      if (e.input) {
        if (!yt[e.input]) return g('Unexpected type of input! Expected "text", "email", "password", "number", "tel", "select", "radio", "checkbox", "textarea", "file" or "url", got "'.concat(e.input, '"'));
        if (o) {
          var c = yt[e.input](e);
          T(c);
        }
      }
    }(t, e), b(U(), e.customClass, "content");
  }
  function Ct(t, i) {
    var r = z();
    if (!i.progressSteps || 0 === i.progressSteps.length) return O(r);
    T(r), r.innerHTML = "";
    var a = parseInt(null === i.currentProgressStep ? ce.getQueueStep() : i.currentProgressStep);
    a >= i.progressSteps.length && y("Invalid currentProgressStep parameter, it should be less than progressSteps.length (currentProgressStep like JS arrays starts from 0)"), i.progressSteps.forEach(function (t, e) {
      var n = function (t) {
        var e = document.createElement("li");
        return nt(e, k["progress-step"]), e.innerHTML = t, e;
      }(t);
      if (r.appendChild(n), e === a && nt(n, k["active-progress-step"]), e !== i.progressSteps.length - 1) {
        var o = function (t) {
          var e = document.createElement("li");
          return nt(e, k["progress-step-line"]), t.progressStepsDistance && (e.style.width = t.progressStepsDistance), e;
        }(t);
        r.appendChild(o);
      }
    });
  }
  function kt(t, e) {
    var n = Q();
    b(n, e.customClass, "header"), Ct(0, e), function (t, e) {
      var n = ht.innerParams.get(t);
      if (n && e.type === n.type && N()) b(N(), e.customClass, "icon");else if (xt(), e.type) if (St(), -1 !== Object.keys(B).indexOf(e.type)) {
        var o = H(".".concat(k.icon, ".").concat(B[e.type]));
        T(o), b(o, e.customClass, "icon"), L(o, "swal2-animate-".concat(e.type, "-icon"), e.animation);
      } else g('Unknown type! Expected "success", "error", "warning", "info" or "question", got "'.concat(e.type, '"'));
    }(t, e), function (t, e) {
      var n = _();
      if (!e.imageUrl) return O(n);
      T(n), n.setAttribute("src", e.imageUrl), n.setAttribute("alt", e.imageAlt), E(n, "width", e.imageWidth), E(n, "height", e.imageHeight), n.className = k.image, b(n, e.customClass, "image"), e.imageClass && nt(n, e.imageClass);
    }(0, e), function (t, e) {
      var n = D();
      M(n, e.title || e.titleText), e.title && tt(e.title, n), e.titleText && (n.innerText = e.titleText), b(n, e.customClass, "title");
    }(0, e), function (t, e) {
      var n = $();
      b(n, e.customClass, "closeButton"), M(n, e.showCloseButton), n.setAttribute("aria-label", e.closeButtonAriaLabel);
    }(0, e);
  }
  function Bt(t, e) {
    !function (t, e) {
      var n = rt();
      E(n, "width", e.width), E(n, "padding", e.padding), e.background && (n.style.background = e.background), n.className = k.popup, e.toast ? (nt([document.documentElement, document.body], k["toast-shown"]), nt(n, k.toast)) : nt(n, k.modal), b(n, e.customClass, "popup"), "string" == typeof e.customClass && nt(n, e.customClass), L(n, k.noanimation, !e.animation);
    }(0, e), mt(0, e), kt(t, e), wt(t, e), ft(0, e), function (t, e) {
      var n = Y();
      M(n, e.footer), e.footer && tt(e.footer, n), b(n, e.customClass, "footer");
    }(0, e);
  }
  var xt = function xt() {
      for (var t = R(), e = 0; e < t.length; e++) O(t[e]);
    },
    St = function St() {
      for (var t = rt(), e = window.getComputedStyle(t).getPropertyValue("background-color"), n = t.querySelectorAll("[class^=swal2-success-circular-line], .swal2-success-fix"), o = 0; o < n.length; o++) n[o].style.backgroundColor = e;
    };
  function Pt() {
    var t = rt();
    t || ce.fire(""), t = rt();
    var e = Z(),
      n = K(),
      o = F();
    T(e), T(n), nt([t, e], k.loading), n.disabled = !0, o.disabled = !0, t.setAttribute("data-loading", !0), t.setAttribute("aria-busy", !0), t.focus();
  }
  function At(t) {
    return Mt.hasOwnProperty(t);
  }
  function Lt(t) {
    return jt[t];
  }
  var Et = [],
    Tt = {},
    Ot = function Ot() {
      return new Promise(function (t) {
        var e = window.scrollX,
          n = window.scrollY;
        Tt.restoreFocusTimeout = setTimeout(function () {
          Tt.previousActiveElement && Tt.previousActiveElement.focus ? (Tt.previousActiveElement.focus(), Tt.previousActiveElement = null) : document.body && document.body.focus(), t();
        }, 100), void 0 !== e && void 0 !== n && window.scrollTo(e, n);
      });
    },
    Mt = {
      title: "",
      titleText: "",
      text: "",
      html: "",
      footer: "",
      type: null,
      toast: !1,
      customClass: "",
      customContainerClass: "",
      target: "body",
      backdrop: !0,
      animation: !0,
      heightAuto: !0,
      allowOutsideClick: !0,
      allowEscapeKey: !0,
      allowEnterKey: !0,
      stopKeydownPropagation: !0,
      keydownListenerCapture: !1,
      showConfirmButton: !0,
      showCancelButton: !1,
      preConfirm: null,
      confirmButtonText: "OK",
      confirmButtonAriaLabel: "",
      confirmButtonColor: null,
      confirmButtonClass: "",
      cancelButtonText: "Cancel",
      cancelButtonAriaLabel: "",
      cancelButtonColor: null,
      cancelButtonClass: "",
      buttonsStyling: !0,
      reverseButtons: !1,
      focusConfirm: !0,
      focusCancel: !1,
      showCloseButton: !1,
      closeButtonAriaLabel: "Close this dialog",
      showLoaderOnConfirm: !1,
      imageUrl: null,
      imageWidth: null,
      imageHeight: null,
      imageAlt: "",
      imageClass: "",
      timer: null,
      width: null,
      padding: null,
      background: null,
      input: null,
      inputPlaceholder: "",
      inputValue: "",
      inputOptions: {},
      inputAutoTrim: !0,
      inputClass: "",
      inputAttributes: {},
      inputValidator: null,
      validationMessage: null,
      grow: !1,
      position: "center",
      progressSteps: [],
      currentProgressStep: null,
      progressStepsDistance: null,
      onBeforeOpen: null,
      onAfterClose: null,
      onOpen: null,
      onClose: null,
      scrollbarPadding: !0
    },
    Vt = ["title", "titleText", "text", "html", "type", "customClass", "showConfirmButton", "showCancelButton", "confirmButtonText", "confirmButtonAriaLabel", "confirmButtonColor", "confirmButtonClass", "cancelButtonText", "cancelButtonAriaLabel", "cancelButtonColor", "cancelButtonClass", "buttonsStyling", "reverseButtons", "imageUrl", "imageWidth", "imageHeigth", "imageAlt", "imageClass", "progressSteps", "currentProgressStep"],
    jt = {
      customContainerClass: "customClass",
      confirmButtonClass: "customClass",
      cancelButtonClass: "customClass",
      imageClass: "customClass",
      inputClass: "customClass"
    },
    qt = ["allowOutsideClick", "allowEnterKey", "backdrop", "focusConfirm", "focusCancel", "heightAuto", "keydownListenerCapture"],
    Ht = Object.freeze({
      isValidParameter: At,
      isUpdatableParameter: function isUpdatableParameter(t) {
        return -1 !== Vt.indexOf(t);
      },
      isDeprecatedParameter: Lt,
      argsToParams: function argsToParams(n) {
        var o = {};
        switch (f(n[0])) {
          case "object":
            a(o, n[0]);
            break;
          default:
            ["title", "html", "type"].forEach(function (t, e) {
              switch (f(n[e])) {
                case "string":
                  o[t] = n[e];
                  break;
                case "undefined":
                  break;
                default:
                  g("Unexpected type of ".concat(t, '! Expected "string", got ').concat(f(n[e])));
              }
            });
        }
        return o;
      },
      isVisible: function isVisible() {
        return V(rt());
      },
      clickConfirm: function clickConfirm() {
        return K() && K().click();
      },
      clickCancel: function clickCancel() {
        return F() && F().click();
      },
      getContainer: q,
      getPopup: rt,
      getTitle: D,
      getContent: U,
      getImage: _,
      getIcon: N,
      getIcons: R,
      getCloseButton: $,
      getActions: Z,
      getConfirmButton: K,
      getCancelButton: F,
      getHeader: Q,
      getFooter: Y,
      getFocusableElements: J,
      getValidationMessage: W,
      isLoading: function isLoading() {
        return rt().hasAttribute("data-loading");
      },
      fire: function fire() {
        for (var t = arguments.length, e = new Array(t), n = 0; n < t; n++) e[n] = arguments[n];
        return c(this, e);
      },
      mixin: function mixin(n) {
        return function (t) {
          function e() {
            return o(this, e), l(this, s(e).apply(this, arguments));
          }
          return function (t, e) {
            if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function");
            t.prototype = Object.create(e && e.prototype, {
              constructor: {
                value: t,
                writable: !0,
                configurable: !0
              }
            }), e && u(t, e);
          }(e, t), r(e, [{
            key: "_main",
            value: function value(t) {
              return d(s(e.prototype), "_main", this).call(this, a({}, n, t));
            }
          }]), e;
        }(this);
      },
      queue: function queue(t) {
        var r = this;
        Et = t;
        function a(t, e) {
          Et = [], document.body.removeAttribute("data-swal2-queue-step"), t(e);
        }
        var s = [];
        return new Promise(function (i) {
          !function e(n, o) {
            n < Et.length ? (document.body.setAttribute("data-swal2-queue-step", n), r.fire(Et[n]).then(function (t) {
              void 0 !== t.value ? (s.push(t.value), e(n + 1, o)) : a(i, {
                dismiss: t.dismiss
              });
            })) : a(i, {
              value: s
            });
          }(0);
        });
      },
      getQueueStep: function getQueueStep() {
        return document.body.getAttribute("data-swal2-queue-step");
      },
      insertQueueStep: function insertQueueStep(t, e) {
        return e && e < Et.length ? Et.splice(e, 0, t) : Et.push(t);
      },
      deleteQueueStep: function deleteQueueStep(t) {
        void 0 !== Et[t] && Et.splice(t, 1);
      },
      showLoading: Pt,
      enableLoading: Pt,
      getTimerLeft: function getTimerLeft() {
        return Tt.timeout && Tt.timeout.getTimerLeft();
      },
      stopTimer: function stopTimer() {
        return Tt.timeout && Tt.timeout.stop();
      },
      resumeTimer: function resumeTimer() {
        return Tt.timeout && Tt.timeout.start();
      },
      toggleTimer: function toggleTimer() {
        var t = Tt.timeout;
        return t && (t.running ? t.stop() : t.start());
      },
      increaseTimer: function increaseTimer(t) {
        return Tt.timeout && Tt.timeout.increase(t);
      },
      isTimerRunning: function isTimerRunning() {
        return Tt.timeout && Tt.timeout.isRunning();
      }
    });
  function It() {
    var t = ht.innerParams.get(this),
      e = ht.domCache.get(this);
    t.showConfirmButton || (O(e.confirmButton), t.showCancelButton || O(e.actions)), ot([e.popup, e.actions], k.loading), e.popup.removeAttribute("aria-busy"), e.popup.removeAttribute("data-loading"), e.confirmButton.disabled = !1, e.cancelButton.disabled = !1;
  }
  function Rt() {
    null === x.previousBodyPadding && document.body.scrollHeight > window.innerHeight && (x.previousBodyPadding = parseInt(window.getComputedStyle(document.body).getPropertyValue("padding-right")), document.body.style.paddingRight = x.previousBodyPadding + function () {
      if ("ontouchstart" in window || navigator.msMaxTouchPoints) return 0;
      var t = document.createElement("div");
      t.style.width = "50px", t.style.height = "50px", t.style.overflow = "scroll", document.body.appendChild(t);
      var e = t.offsetWidth - t.clientWidth;
      return document.body.removeChild(t), e;
    }() + "px");
  }
  function Nt() {
    return !!window.MSInputMethodContext && !!document.documentMode;
  }
  function Dt() {
    var t = q(),
      e = rt();
    t.style.removeProperty("align-items"), e.offsetTop < 0 && (t.style.alignItems = "flex-start");
  }
  var Ut = function Ut() {
      null !== x.previousBodyPadding && (document.body.style.paddingRight = x.previousBodyPadding + "px", x.previousBodyPadding = null);
    },
    _t = function _t() {
      var e,
        n = q();
      n.ontouchstart = function (t) {
        e = t.target === n || !function (t) {
          return !!(t.scrollHeight > t.clientHeight);
        }(n) && "INPUT" !== t.target.tagName;
      }, n.ontouchmove = function (t) {
        e && (t.preventDefault(), t.stopPropagation());
      };
    },
    zt = function zt() {
      if (S(document.body, k.iosfix)) {
        var t = parseInt(document.body.style.top, 10);
        ot(document.body, k.iosfix), document.body.style.top = "", document.body.scrollTop = -1 * t;
      }
    },
    Wt = function Wt() {
      "undefined" != typeof window && Nt() && window.removeEventListener("resize", Dt);
    },
    Kt = function Kt() {
      m(document.body.children).forEach(function (t) {
        t.hasAttribute("data-previous-aria-hidden") ? (t.setAttribute("aria-hidden", t.getAttribute("data-previous-aria-hidden")), t.removeAttribute("data-previous-aria-hidden")) : t.removeAttribute("aria-hidden");
      });
    },
    Ft = {
      swalPromiseResolve: new WeakMap()
    };
  function Zt(t, e, n) {
    e ? $t(n) : (Ot().then(function () {
      return $t(n);
    }), Tt.keydownTarget.removeEventListener("keydown", Tt.keydownHandler, {
      capture: Tt.keydownListenerCapture
    }), Tt.keydownHandlerAdded = !1), delete Tt.keydownHandler, delete Tt.keydownTarget, t.parentNode && t.parentNode.removeChild(t), ot([document.documentElement, document.body], [k.shown, k["height-auto"], k["no-backdrop"], k["toast-shown"], k["toast-column"]]), at() && (Ut(), zt(), Wt(), Kt());
  }
  function Qt(t) {
    var e = q(),
      n = rt();
    if (n && !S(n, k.hide)) {
      var o = ht.innerParams.get(this),
        i = Ft.swalPromiseResolve.get(this),
        r = o.onClose,
        a = o.onAfterClose;
      ot(n, k.show), nt(n, k.hide), dt && j(n) ? n.addEventListener(dt, function (t) {
        t.target === n && function (t, e, n, o) {
          S(t, k.hide) && Zt(e, n, o), Yt(ht), Yt(Ft);
        }(n, e, st(), a);
      }) : Zt(e, st(), a), null !== r && "function" == typeof r && r(n), i(t || {}), delete this.params;
    }
  }
  var Yt = function Yt(t) {
      for (var e in t) t[e] = new WeakMap();
    },
    $t = function $t(t) {
      null !== t && "function" == typeof t && setTimeout(function () {
        t();
      });
    };
  function Jt(t, e, n) {
    var o = ht.domCache.get(t);
    e.forEach(function (t) {
      o[t].disabled = n;
    });
  }
  function Xt(t, e) {
    if (!t) return !1;
    if ("radio" === t.type) for (var n = t.parentNode.parentNode.querySelectorAll("input"), o = 0; o < n.length; o++) n[o].disabled = e;else t.disabled = e;
  }
  var Gt = function () {
      function n(t, e) {
        o(this, n), this.callback = t, this.remaining = e, this.running = !1, this.start();
      }
      return r(n, [{
        key: "start",
        value: function value() {
          return this.running || (this.running = !0, this.started = new Date(), this.id = setTimeout(this.callback, this.remaining)), this.remaining;
        }
      }, {
        key: "stop",
        value: function value() {
          return this.running && (this.running = !1, clearTimeout(this.id), this.remaining -= new Date() - this.started), this.remaining;
        }
      }, {
        key: "increase",
        value: function value(t) {
          var e = this.running;
          return e && this.stop(), this.remaining += t, e && this.start(), this.remaining;
        }
      }, {
        key: "getTimerLeft",
        value: function value() {
          return this.running && (this.stop(), this.start()), this.remaining;
        }
      }, {
        key: "isRunning",
        value: function value() {
          return this.running;
        }
      }]), n;
    }(),
    te = {
      email: function email(t, e) {
        return /^[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9-]{2,24}$/.test(t) ? Promise.resolve() : Promise.resolve(e || "Invalid email address");
      },
      url: function url(t, e) {
        return /^https?:\/\/(www\.)?[-a-zA-Z0-9@:%._+~#=]{2,256}\.[a-z]{2,63}\b([-a-zA-Z0-9@:%_+.~#?&/=]*)$/.test(t) ? Promise.resolve() : Promise.resolve(e || "Invalid URL");
      }
    };
  function ee(t, e) {
    t.removeEventListener(dt, ee), e.style.overflowY = "auto";
  }
  function ne(t) {
    var e = q(),
      n = rt();
    null !== t.onBeforeOpen && "function" == typeof t.onBeforeOpen && t.onBeforeOpen(n), t.animation && (nt(n, k.show), nt(e, k.fade)), T(n), dt && j(n) ? (e.style.overflowY = "hidden", n.addEventListener(dt, ee.bind(null, n, e))) : e.style.overflowY = "auto", nt([document.documentElement, document.body, e], k.shown), t.heightAuto && t.backdrop && !t.toast && nt([document.documentElement, document.body], k["height-auto"]), at() && (t.scrollbarPadding && Rt(), function () {
      if (/iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream && !S(document.body, k.iosfix)) {
        var t = document.body.scrollTop;
        document.body.style.top = -1 * t + "px", nt(document.body, k.iosfix), _t();
      }
    }(), "undefined" != typeof window && Nt() && (Dt(), window.addEventListener("resize", Dt)), m(document.body.children).forEach(function (t) {
      t === q() || function (t, e) {
        if ("function" == typeof t.contains) return t.contains(e);
      }(t, q()) || (t.hasAttribute("aria-hidden") && t.setAttribute("data-previous-aria-hidden", t.getAttribute("aria-hidden")), t.setAttribute("aria-hidden", "true"));
    }), setTimeout(function () {
      e.scrollTop = 0;
    })), st() || Tt.previousActiveElement || (Tt.previousActiveElement = document.activeElement), null !== t.onOpen && "function" == typeof t.onOpen && setTimeout(function () {
      t.onOpen(n);
    });
  }
  var oe = void 0,
    ie = {
      select: function select(t, e, i) {
        var r = it(t, k.select);
        e.forEach(function (t) {
          var e = t[0],
            n = t[1],
            o = document.createElement("option");
          o.value = e, o.innerHTML = n, i.inputValue.toString() === e.toString() && (o.selected = !0), r.appendChild(o);
        }), r.focus();
      },
      radio: function radio(t, e, a) {
        var s = it(t, k.radio);
        e.forEach(function (t) {
          var e = t[0],
            n = t[1],
            o = document.createElement("input"),
            i = document.createElement("label");
          o.type = "radio", o.name = k.radio, o.value = e, a.inputValue.toString() === e.toString() && (o.checked = !0);
          var r = document.createElement("span");
          r.innerHTML = n, r.className = k.label, i.appendChild(o), i.appendChild(r), s.appendChild(i);
        });
        var n = s.querySelectorAll("input");
        n.length && n[0].focus();
      }
    },
    re = function re(e) {
      var n = [];
      return "undefined" != typeof Map && e instanceof Map ? e.forEach(function (t, e) {
        n.push([e, t]);
      }) : Object.keys(e).forEach(function (t) {
        n.push([t, e[t]]);
      }), n;
    };
  var ae,
    se = Object.freeze({
      hideLoading: It,
      disableLoading: It,
      getInput: function getInput(t) {
        var e = ht.innerParams.get(t || this);
        return P(ht.domCache.get(t || this).content, e.input);
      },
      close: Qt,
      closePopup: Qt,
      closeModal: Qt,
      closeToast: Qt,
      enableButtons: function enableButtons() {
        Jt(this, ["confirmButton", "cancelButton"], !1);
      },
      disableButtons: function disableButtons() {
        Jt(this, ["confirmButton", "cancelButton"], !0);
      },
      enableConfirmButton: function enableConfirmButton() {
        h("Swal.disableConfirmButton()", "Swal.getConfirmButton().removeAttribute('disabled')"), Jt(this, ["confirmButton"], !1);
      },
      disableConfirmButton: function disableConfirmButton() {
        h("Swal.enableConfirmButton()", "Swal.getConfirmButton().setAttribute('disabled', '')"), Jt(this, ["confirmButton"], !0);
      },
      enableInput: function enableInput() {
        return Xt(this.getInput(), !1);
      },
      disableInput: function disableInput() {
        return Xt(this.getInput(), !0);
      },
      showValidationMessage: function showValidationMessage(t) {
        var e = ht.domCache.get(this);
        e.validationMessage.innerHTML = t;
        var n = window.getComputedStyle(e.popup);
        e.validationMessage.style.marginLeft = "-".concat(n.getPropertyValue("padding-left")), e.validationMessage.style.marginRight = "-".concat(n.getPropertyValue("padding-right")), T(e.validationMessage);
        var o = this.getInput();
        o && (o.setAttribute("aria-invalid", !0), o.setAttribute("aria-describedBy", k["validation-message"]), A(o), nt(o, k.inputerror));
      },
      resetValidationMessage: function resetValidationMessage() {
        var t = ht.domCache.get(this);
        t.validationMessage && O(t.validationMessage);
        var e = this.getInput();
        e && (e.removeAttribute("aria-invalid"), e.removeAttribute("aria-describedBy"), ot(e, k.inputerror));
      },
      getProgressSteps: function getProgressSteps() {
        return h("Swal.getProgressSteps()", "const swalInstance = Swal.fire({progressSteps: ['1', '2', '3']}); const progressSteps = swalInstance.params.progressSteps"), ht.innerParams.get(this).progressSteps;
      },
      setProgressSteps: function setProgressSteps(t) {
        h("Swal.setProgressSteps()", "Swal.update()");
        var e = a({}, ht.innerParams.get(this), {
          progressSteps: t
        });
        Ct(0, e), ht.innerParams.set(this, e);
      },
      showProgressSteps: function showProgressSteps() {
        var t = ht.domCache.get(this);
        T(t.progressSteps);
      },
      hideProgressSteps: function hideProgressSteps() {
        var t = ht.domCache.get(this);
        O(t.progressSteps);
      },
      _main: function _main(t) {
        var c = this;
        !function (t) {
          for (var e in t) At(i = e) || y('Unknown parameter "'.concat(i, '"')), t.toast && (o = e, -1 !== qt.indexOf(o) && y('The parameter "'.concat(o, '" is incompatible with toasts'))), Lt(n = void 0) && h(n, Lt(n));
          var n, o, i;
        }(t);
        var l = a({}, Mt, t);
        !function (e) {
          e.inputValidator || Object.keys(te).forEach(function (t) {
            e.input === t && (e.inputValidator = te[t]);
          }), e.showLoaderOnConfirm && !e.preConfirm && y("showLoaderOnConfirm is set to true, but preConfirm is not defined.\nshowLoaderOnConfirm should be used together with preConfirm, see usage example:\nhttps://sweetalert2.github.io/#ajax-request"), e.animation = w(e.animation), e.target && ("string" != typeof e.target || document.querySelector(e.target)) && ("string" == typeof e.target || e.target.appendChild) || (y('Target parameter is not valid, defaulting to "body"'), e.target = "body"), "string" == typeof e.title && (e.title = e.title.split("\n").join("<br />"));
          var t = rt(),
            n = "string" == typeof e.target ? document.querySelector(e.target) : e.target;
          (!t || t && n && t.parentNode !== n.parentNode) && ct(e);
        }(l), Object.freeze(l), Tt.timeout && (Tt.timeout.stop(), delete Tt.timeout), clearTimeout(Tt.restoreFocusTimeout);
        var d = {
          popup: rt(),
          container: q(),
          content: U(),
          actions: Z(),
          confirmButton: K(),
          cancelButton: F(),
          closeButton: $(),
          validationMessage: W(),
          progressSteps: z()
        };
        ht.domCache.set(this, d), Bt(this, l), ht.innerParams.set(this, l);
        var p = this.constructor;
        return new Promise(function (t) {
          function n(t) {
            c.closePopup({
              value: t
            });
          }
          function s(t) {
            c.closePopup({
              dismiss: t
            });
          }
          Ft.swalPromiseResolve.set(c, t), l.timer && (Tt.timeout = new Gt(function () {
            s("timer"), delete Tt.timeout;
          }, l.timer));
          l.input && setTimeout(function () {
            var t = c.getInput();
            t && A(t);
          }, 0);
          for (var u = function u(e) {
              (l.showLoaderOnConfirm && p.showLoading(), l.preConfirm) ? (c.resetValidationMessage(), Promise.resolve().then(function () {
                return l.preConfirm(e, l.validationMessage);
              }).then(function (t) {
                V(d.validationMessage) || !1 === t ? c.hideLoading() : n(void 0 === t ? e : t);
              })) : n(e);
            }, e = function e(t) {
              var e = t.target,
                n = d.confirmButton,
                o = d.cancelButton,
                i = n && (n === e || n.contains(e)),
                r = o && (o === e || o.contains(e));
              switch (t.type) {
                case "click":
                  if (i) {
                    if (c.disableButtons(), l.input) {
                      var a = function () {
                        var t = c.getInput();
                        if (!t) return null;
                        switch (l.input) {
                          case "checkbox":
                            return t.checked ? 1 : 0;
                          case "radio":
                            return t.checked ? t.value : null;
                          case "file":
                            return t.files.length ? t.files[0] : null;
                          default:
                            return l.inputAutoTrim ? t.value.trim() : t.value;
                        }
                      }();
                      if (l.inputValidator) c.disableInput(), Promise.resolve().then(function () {
                        return l.inputValidator(a, l.validationMessage);
                      }).then(function (t) {
                        c.enableButtons(), c.enableInput(), t ? c.showValidationMessage(t) : u(a);
                      });else c.getInput().checkValidity() ? u(a) : (c.enableButtons(), c.showValidationMessage(l.validationMessage));
                    } else u(!0);
                  } else r && (c.disableButtons(), s(p.DismissReason.cancel));
              }
            }, o = d.popup.querySelectorAll("button"), i = 0; i < o.length; i++) o[i].onclick = e, o[i].onmouseover = e, o[i].onmouseout = e, o[i].onmousedown = e;
          if (d.closeButton.onclick = function () {
            s(p.DismissReason.close);
          }, l.toast) d.popup.onclick = function () {
            l.showConfirmButton || l.showCancelButton || l.showCloseButton || l.input || s(p.DismissReason.close);
          };else {
            var r = !1;
            d.popup.onmousedown = function () {
              d.container.onmouseup = function (t) {
                d.container.onmouseup = void 0, t.target === d.container && (r = !0);
              };
            }, d.container.onmousedown = function () {
              d.popup.onmouseup = function (t) {
                d.popup.onmouseup = void 0, t.target !== d.popup && !d.popup.contains(t.target) || (r = !0);
              };
            }, d.container.onclick = function (t) {
              r ? r = !1 : t.target === d.container && w(l.allowOutsideClick) && s(p.DismissReason.backdrop);
            };
          }
          l.reverseButtons ? d.confirmButton.parentNode.insertBefore(d.cancelButton, d.confirmButton) : d.confirmButton.parentNode.insertBefore(d.confirmButton, d.cancelButton);
          function a(t, e) {
            for (var n = J(l.focusCancel), o = 0; o < n.length; o++) return (t += e) === n.length ? t = 0 : -1 === t && (t = n.length - 1), n[t].focus();
            d.popup.focus();
          }
          Tt.keydownTarget && Tt.keydownHandlerAdded && (Tt.keydownTarget.removeEventListener("keydown", Tt.keydownHandler, {
            capture: Tt.keydownListenerCapture
          }), Tt.keydownHandlerAdded = !1), l.toast || (Tt.keydownHandler = function (t) {
            return function (t, e) {
              e.stopKeydownPropagation && t.stopPropagation();
              if ("Enter" !== t.key || t.isComposing) {
                if ("Tab" === t.key) {
                  for (var n = t.target, o = J(e.focusCancel), i = -1, r = 0; r < o.length; r++) if (n === o[r]) {
                    i = r;
                    break;
                  }
                  t.shiftKey ? a(i, -1) : a(i, 1), t.stopPropagation(), t.preventDefault();
                } else -1 !== ["ArrowLeft", "ArrowRight", "ArrowUp", "ArrowDown", "Left", "Right", "Up", "Down"].indexOf(t.key) ? document.activeElement === d.confirmButton && V(d.cancelButton) ? d.cancelButton.focus() : document.activeElement === d.cancelButton && V(d.confirmButton) && d.confirmButton.focus() : "Escape" !== t.key && "Esc" !== t.key || !0 !== w(e.allowEscapeKey) || (t.preventDefault(), s(p.DismissReason.esc));
              } else if (t.target && c.getInput() && t.target.outerHTML === c.getInput().outerHTML) {
                if (-1 !== ["textarea", "file"].indexOf(e.input)) return;
                p.clickConfirm(), t.preventDefault();
              }
            }(t, l);
          }, Tt.keydownTarget = l.keydownListenerCapture ? window : d.popup, Tt.keydownListenerCapture = l.keydownListenerCapture, Tt.keydownTarget.addEventListener("keydown", Tt.keydownHandler, {
            capture: Tt.keydownListenerCapture
          }), Tt.keydownHandlerAdded = !0), c.enableButtons(), c.hideLoading(), c.resetValidationMessage(), l.toast && (l.input || l.footer || l.showCloseButton) ? nt(document.body, k["toast-column"]) : ot(document.body, k["toast-column"]), "select" === l.input || "radio" === l.input ? function (e, n) {
            function o(t) {
              return ie[n.input](i, re(t), n);
            }
            var i = U();
            v(n.inputOptions) ? (Pt(), n.inputOptions.then(function (t) {
              e.hideLoading(), o(t);
            })) : "object" === f(n.inputOptions) ? o(n.inputOptions) : g("Unexpected type of inputOptions! Expected object, Map or Promise, got ".concat(f(n.inputOptions)));
          }(c, l) : -1 !== ["text", "email", "number", "tel", "textarea"].indexOf(l.input) && v(l.inputValue) && function (e, n) {
            var o = e.getInput();
            O(o), n.inputValue.then(function (t) {
              o.value = "number" === n.input ? parseFloat(t) || 0 : t + "", T(o), o.focus(), e.hideLoading();
            })["catch"](function (t) {
              g("Error in inputValue promise: " + t), o.value = "", T(o), o.focus(), oe.hideLoading();
            });
          }(c, l), ne(l), l.toast || (w(l.allowEnterKey) ? l.focusCancel && V(d.cancelButton) ? d.cancelButton.focus() : l.focusConfirm && V(d.confirmButton) ? d.confirmButton.focus() : a(-1, 1) : document.activeElement && "function" == typeof document.activeElement.blur && document.activeElement.blur()), d.container.scrollTop = 0;
        });
      },
      update: function update(e) {
        var n = {};
        Object.keys(e).forEach(function (t) {
          ce.isUpdatableParameter(t) ? n[t] = e[t] : y('Invalid parameter to update: "'.concat(t, '". Updatable params are listed here: https://github.com/sweetalert2/sweetalert2/blob/master/src/utils/params.js'));
        });
        var t = a({}, ht.innerParams.get(this), n);
        Bt(this, t), ht.innerParams.set(this, t), Object.defineProperties(this, {
          params: {
            value: a({}, this.params, e),
            writable: !1,
            enumerable: !0
          }
        });
      }
    });
  function ue() {
    if ("undefined" != typeof window) {
      "undefined" == typeof Promise && g("This package requires a Promise library, please include a shim to enable it in this browser (See: https://github.com/sweetalert2/sweetalert2/wiki/Migration-from-SweetAlert-to-SweetAlert2#1-ie-support)"), ae = this;
      for (var t = arguments.length, e = new Array(t), n = 0; n < t; n++) e[n] = arguments[n];
      var o = Object.freeze(this.constructor.argsToParams(e));
      Object.defineProperties(this, {
        params: {
          value: o,
          writable: !1,
          enumerable: !0,
          configurable: !0
        }
      });
      var i = this._main(this.params);
      ht.promise.set(this, i);
    }
  }
  ue.prototype.then = function (t) {
    return ht.promise.get(this).then(t);
  }, ue.prototype["finally"] = function (t) {
    return ht.promise.get(this)["finally"](t);
  }, a(ue.prototype, se), a(ue, Ht), Object.keys(se).forEach(function (e) {
    ue[e] = function () {
      var t;
      if (ae) return (t = ae)[e].apply(t, arguments);
    };
  }), ue.DismissReason = C, ue.version = "8.11.8";
  var ce = ue;
  return ce["default"] = ce;
}), "undefined" != typeof window && window.Sweetalert2 && (window.swal = window.sweetAlert = window.Swal = window.SweetAlert = window.Sweetalert2);
"undefined" != typeof document && function (e, t) {
  var n = e.createElement("style");
  if (e.getElementsByTagName("head")[0].appendChild(n), n.styleSheet) n.styleSheet.disabled || (n.styleSheet.cssText = t);else try {
    n.innerHTML = t;
  } catch (e) {
    n.innerText = t;
  }
}(document, "@charset \"UTF-8\";@-webkit-keyframes swal2-show{0%{-webkit-transform:scale(.7);transform:scale(.7)}45%{-webkit-transform:scale(1.05);transform:scale(1.05)}80%{-webkit-transform:scale(.95);transform:scale(.95)}100%{-webkit-transform:scale(1);transform:scale(1)}}@keyframes swal2-show{0%{-webkit-transform:scale(.7);transform:scale(.7)}45%{-webkit-transform:scale(1.05);transform:scale(1.05)}80%{-webkit-transform:scale(.95);transform:scale(.95)}100%{-webkit-transform:scale(1);transform:scale(1)}}@-webkit-keyframes swal2-hide{0%{-webkit-transform:scale(1);transform:scale(1);opacity:1}100%{-webkit-transform:scale(.5);transform:scale(.5);opacity:0}}@keyframes swal2-hide{0%{-webkit-transform:scale(1);transform:scale(1);opacity:1}100%{-webkit-transform:scale(.5);transform:scale(.5);opacity:0}}@-webkit-keyframes swal2-animate-success-line-tip{0%{top:1.1875em;left:.0625em;width:0}54%{top:1.0625em;left:.125em;width:0}70%{top:2.1875em;left:-.375em;width:3.125em}84%{top:3em;left:1.3125em;width:1.0625em}100%{top:2.8125em;left:.875em;width:1.5625em}}@keyframes swal2-animate-success-line-tip{0%{top:1.1875em;left:.0625em;width:0}54%{top:1.0625em;left:.125em;width:0}70%{top:2.1875em;left:-.375em;width:3.125em}84%{top:3em;left:1.3125em;width:1.0625em}100%{top:2.8125em;left:.875em;width:1.5625em}}@-webkit-keyframes swal2-animate-success-line-long{0%{top:3.375em;right:2.875em;width:0}65%{top:3.375em;right:2.875em;width:0}84%{top:2.1875em;right:0;width:3.4375em}100%{top:2.375em;right:.5em;width:2.9375em}}@keyframes swal2-animate-success-line-long{0%{top:3.375em;right:2.875em;width:0}65%{top:3.375em;right:2.875em;width:0}84%{top:2.1875em;right:0;width:3.4375em}100%{top:2.375em;right:.5em;width:2.9375em}}@-webkit-keyframes swal2-rotate-success-circular-line{0%{-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}5%{-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}12%{-webkit-transform:rotate(-405deg);transform:rotate(-405deg)}100%{-webkit-transform:rotate(-405deg);transform:rotate(-405deg)}}@keyframes swal2-rotate-success-circular-line{0%{-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}5%{-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}12%{-webkit-transform:rotate(-405deg);transform:rotate(-405deg)}100%{-webkit-transform:rotate(-405deg);transform:rotate(-405deg)}}@-webkit-keyframes swal2-animate-error-x-mark{0%{margin-top:1.625em;-webkit-transform:scale(.4);transform:scale(.4);opacity:0}50%{margin-top:1.625em;-webkit-transform:scale(.4);transform:scale(.4);opacity:0}80%{margin-top:-.375em;-webkit-transform:scale(1.15);transform:scale(1.15)}100%{margin-top:0;-webkit-transform:scale(1);transform:scale(1);opacity:1}}@keyframes swal2-animate-error-x-mark{0%{margin-top:1.625em;-webkit-transform:scale(.4);transform:scale(.4);opacity:0}50%{margin-top:1.625em;-webkit-transform:scale(.4);transform:scale(.4);opacity:0}80%{margin-top:-.375em;-webkit-transform:scale(1.15);transform:scale(1.15)}100%{margin-top:0;-webkit-transform:scale(1);transform:scale(1);opacity:1}}@-webkit-keyframes swal2-animate-error-icon{0%{-webkit-transform:rotateX(100deg);transform:rotateX(100deg);opacity:0}100%{-webkit-transform:rotateX(0);transform:rotateX(0);opacity:1}}@keyframes swal2-animate-error-icon{0%{-webkit-transform:rotateX(100deg);transform:rotateX(100deg);opacity:0}100%{-webkit-transform:rotateX(0);transform:rotateX(0);opacity:1}}body.swal2-toast-shown .swal2-container{background-color:transparent}body.swal2-toast-shown .swal2-container.swal2-shown{background-color:transparent}body.swal2-toast-shown .swal2-container.swal2-top{top:0;right:auto;bottom:auto;left:50%;-webkit-transform:translateX(-50%);transform:translateX(-50%)}body.swal2-toast-shown .swal2-container.swal2-top-end,body.swal2-toast-shown .swal2-container.swal2-top-right{top:0;right:0;bottom:auto;left:auto}body.swal2-toast-shown .swal2-container.swal2-top-left,body.swal2-toast-shown .swal2-container.swal2-top-start{top:0;right:auto;bottom:auto;left:0}body.swal2-toast-shown .swal2-container.swal2-center-left,body.swal2-toast-shown .swal2-container.swal2-center-start{top:50%;right:auto;bottom:auto;left:0;-webkit-transform:translateY(-50%);transform:translateY(-50%)}body.swal2-toast-shown .swal2-container.swal2-center{top:50%;right:auto;bottom:auto;left:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}body.swal2-toast-shown .swal2-container.swal2-center-end,body.swal2-toast-shown .swal2-container.swal2-center-right{top:50%;right:0;bottom:auto;left:auto;-webkit-transform:translateY(-50%);transform:translateY(-50%)}body.swal2-toast-shown .swal2-container.swal2-bottom-left,body.swal2-toast-shown .swal2-container.swal2-bottom-start{top:auto;right:auto;bottom:0;left:0}body.swal2-toast-shown .swal2-container.swal2-bottom{top:auto;right:auto;bottom:0;left:50%;-webkit-transform:translateX(-50%);transform:translateX(-50%)}body.swal2-toast-shown .swal2-container.swal2-bottom-end,body.swal2-toast-shown .swal2-container.swal2-bottom-right{top:auto;right:0;bottom:0;left:auto}body.swal2-toast-column .swal2-toast{flex-direction:column;align-items:stretch}body.swal2-toast-column .swal2-toast .swal2-actions{flex:1;align-self:stretch;height:2.2em;margin-top:.3125em}body.swal2-toast-column .swal2-toast .swal2-loading{justify-content:center}body.swal2-toast-column .swal2-toast .swal2-input{height:2em;margin:.3125em auto;font-size:1em}body.swal2-toast-column .swal2-toast .swal2-validation-message{font-size:1em}.swal2-popup.swal2-toast{flex-direction:row;align-items:center;width:auto;padding:.625em;overflow-y:hidden;box-shadow:0 0 .625em #d9d9d9}.swal2-popup.swal2-toast .swal2-header{flex-direction:row}.swal2-popup.swal2-toast .swal2-title{flex-grow:1;justify-content:flex-start;margin:0 .6em;font-size:1em}.swal2-popup.swal2-toast .swal2-footer{margin:.5em 0 0;padding:.5em 0 0;font-size:.8em}.swal2-popup.swal2-toast .swal2-close{position:static;width:.8em;height:.8em;line-height:.8}.swal2-popup.swal2-toast .swal2-content{justify-content:flex-start;font-size:1em}.swal2-popup.swal2-toast .swal2-icon{width:2em;min-width:2em;height:2em;margin:0}.swal2-popup.swal2-toast .swal2-icon::before{display:flex;align-items:center;font-size:2em;font-weight:700}@media all and (-ms-high-contrast:none),(-ms-high-contrast:active){.swal2-popup.swal2-toast .swal2-icon::before{font-size:.25em}}.swal2-popup.swal2-toast .swal2-icon.swal2-success .swal2-success-ring{width:2em;height:2em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line]{top:.875em;width:1.375em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left]{left:.3125em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right]{right:.3125em}.swal2-popup.swal2-toast .swal2-actions{flex-basis:auto!important;height:auto;margin:0 .3125em}.swal2-popup.swal2-toast .swal2-styled{margin:0 .3125em;padding:.3125em .625em;font-size:1em}.swal2-popup.swal2-toast .swal2-styled:focus{box-shadow:0 0 0 .0625em #fff,0 0 0 .125em rgba(50,100,150,.4)}.swal2-popup.swal2-toast .swal2-success{border-color:#a5dc86}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line]{position:absolute;width:1.6em;height:3em;-webkit-transform:rotate(45deg);transform:rotate(45deg);border-radius:50%}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=left]{top:-.8em;left:-.5em;-webkit-transform:rotate(-45deg);transform:rotate(-45deg);-webkit-transform-origin:2em 2em;transform-origin:2em 2em;border-radius:4em 0 0 4em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=right]{top:-.25em;left:.9375em;-webkit-transform-origin:0 1.5em;transform-origin:0 1.5em;border-radius:0 4em 4em 0}.swal2-popup.swal2-toast .swal2-success .swal2-success-ring{width:2em;height:2em}.swal2-popup.swal2-toast .swal2-success .swal2-success-fix{top:0;left:.4375em;width:.4375em;height:2.6875em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line]{height:.3125em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=tip]{top:1.125em;left:.1875em;width:.75em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=long]{top:.9375em;right:.1875em;width:1.375em}.swal2-popup.swal2-toast.swal2-show{-webkit-animation:swal2-toast-show .5s;animation:swal2-toast-show .5s}.swal2-popup.swal2-toast.swal2-hide{-webkit-animation:swal2-toast-hide .1s forwards;animation:swal2-toast-hide .1s forwards}.swal2-popup.swal2-toast .swal2-animate-success-icon .swal2-success-line-tip{-webkit-animation:swal2-toast-animate-success-line-tip .75s;animation:swal2-toast-animate-success-line-tip .75s}.swal2-popup.swal2-toast .swal2-animate-success-icon .swal2-success-line-long{-webkit-animation:swal2-toast-animate-success-line-long .75s;animation:swal2-toast-animate-success-line-long .75s}@-webkit-keyframes swal2-toast-show{0%{-webkit-transform:translateY(-.625em) rotateZ(2deg);transform:translateY(-.625em) rotateZ(2deg)}33%{-webkit-transform:translateY(0) rotateZ(-2deg);transform:translateY(0) rotateZ(-2deg)}66%{-webkit-transform:translateY(.3125em) rotateZ(2deg);transform:translateY(.3125em) rotateZ(2deg)}100%{-webkit-transform:translateY(0) rotateZ(0);transform:translateY(0) rotateZ(0)}}@keyframes swal2-toast-show{0%{-webkit-transform:translateY(-.625em) rotateZ(2deg);transform:translateY(-.625em) rotateZ(2deg)}33%{-webkit-transform:translateY(0) rotateZ(-2deg);transform:translateY(0) rotateZ(-2deg)}66%{-webkit-transform:translateY(.3125em) rotateZ(2deg);transform:translateY(.3125em) rotateZ(2deg)}100%{-webkit-transform:translateY(0) rotateZ(0);transform:translateY(0) rotateZ(0)}}@-webkit-keyframes swal2-toast-hide{100%{-webkit-transform:rotateZ(1deg);transform:rotateZ(1deg);opacity:0}}@keyframes swal2-toast-hide{100%{-webkit-transform:rotateZ(1deg);transform:rotateZ(1deg);opacity:0}}@-webkit-keyframes swal2-toast-animate-success-line-tip{0%{top:.5625em;left:.0625em;width:0}54%{top:.125em;left:.125em;width:0}70%{top:.625em;left:-.25em;width:1.625em}84%{top:1.0625em;left:.75em;width:.5em}100%{top:1.125em;left:.1875em;width:.75em}}@keyframes swal2-toast-animate-success-line-tip{0%{top:.5625em;left:.0625em;width:0}54%{top:.125em;left:.125em;width:0}70%{top:.625em;left:-.25em;width:1.625em}84%{top:1.0625em;left:.75em;width:.5em}100%{top:1.125em;left:.1875em;width:.75em}}@-webkit-keyframes swal2-toast-animate-success-line-long{0%{top:1.625em;right:1.375em;width:0}65%{top:1.25em;right:.9375em;width:0}84%{top:.9375em;right:0;width:1.125em}100%{top:.9375em;right:.1875em;width:1.375em}}@keyframes swal2-toast-animate-success-line-long{0%{top:1.625em;right:1.375em;width:0}65%{top:1.25em;right:.9375em;width:0}84%{top:.9375em;right:0;width:1.125em}100%{top:.9375em;right:.1875em;width:1.375em}}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown){overflow:hidden}body.swal2-height-auto{height:auto!important}body.swal2-no-backdrop .swal2-shown{top:auto;right:auto;bottom:auto;left:auto;max-width:calc(100% - .625em * 2);background-color:transparent}body.swal2-no-backdrop .swal2-shown>.swal2-modal{box-shadow:0 0 10px rgba(0,0,0,.4)}body.swal2-no-backdrop .swal2-shown.swal2-top{top:0;left:50%;-webkit-transform:translateX(-50%);transform:translateX(-50%)}body.swal2-no-backdrop .swal2-shown.swal2-top-left,body.swal2-no-backdrop .swal2-shown.swal2-top-start{top:0;left:0}body.swal2-no-backdrop .swal2-shown.swal2-top-end,body.swal2-no-backdrop .swal2-shown.swal2-top-right{top:0;right:0}body.swal2-no-backdrop .swal2-shown.swal2-center{top:50%;left:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}body.swal2-no-backdrop .swal2-shown.swal2-center-left,body.swal2-no-backdrop .swal2-shown.swal2-center-start{top:50%;left:0;-webkit-transform:translateY(-50%);transform:translateY(-50%)}body.swal2-no-backdrop .swal2-shown.swal2-center-end,body.swal2-no-backdrop .swal2-shown.swal2-center-right{top:50%;right:0;-webkit-transform:translateY(-50%);transform:translateY(-50%)}body.swal2-no-backdrop .swal2-shown.swal2-bottom{bottom:0;left:50%;-webkit-transform:translateX(-50%);transform:translateX(-50%)}body.swal2-no-backdrop .swal2-shown.swal2-bottom-left,body.swal2-no-backdrop .swal2-shown.swal2-bottom-start{bottom:0;left:0}body.swal2-no-backdrop .swal2-shown.swal2-bottom-end,body.swal2-no-backdrop .swal2-shown.swal2-bottom-right{right:0;bottom:0}.swal2-container{display:flex;position:fixed;z-index:1060;top:0;right:0;bottom:0;left:0;flex-direction:row;align-items:center;justify-content:center;padding:.625em;overflow-x:hidden;background-color:transparent;-webkit-overflow-scrolling:touch}.swal2-container.swal2-top{align-items:flex-start}.swal2-container.swal2-top-left,.swal2-container.swal2-top-start{align-items:flex-start;justify-content:flex-start}.swal2-container.swal2-top-end,.swal2-container.swal2-top-right{align-items:flex-start;justify-content:flex-end}.swal2-container.swal2-center{align-items:center}.swal2-container.swal2-center-left,.swal2-container.swal2-center-start{align-items:center;justify-content:flex-start}.swal2-container.swal2-center-end,.swal2-container.swal2-center-right{align-items:center;justify-content:flex-end}.swal2-container.swal2-bottom{align-items:flex-end}.swal2-container.swal2-bottom-left,.swal2-container.swal2-bottom-start{align-items:flex-end;justify-content:flex-start}.swal2-container.swal2-bottom-end,.swal2-container.swal2-bottom-right{align-items:flex-end;justify-content:flex-end}.swal2-container.swal2-bottom-end>:first-child,.swal2-container.swal2-bottom-left>:first-child,.swal2-container.swal2-bottom-right>:first-child,.swal2-container.swal2-bottom-start>:first-child,.swal2-container.swal2-bottom>:first-child{margin-top:auto}.swal2-container.swal2-grow-fullscreen>.swal2-modal{display:flex!important;flex:1;align-self:stretch;justify-content:center}.swal2-container.swal2-grow-row>.swal2-modal{display:flex!important;flex:1;align-content:center;justify-content:center}.swal2-container.swal2-grow-column{flex:1;flex-direction:column}.swal2-container.swal2-grow-column.swal2-bottom,.swal2-container.swal2-grow-column.swal2-center,.swal2-container.swal2-grow-column.swal2-top{align-items:center}.swal2-container.swal2-grow-column.swal2-bottom-left,.swal2-container.swal2-grow-column.swal2-bottom-start,.swal2-container.swal2-grow-column.swal2-center-left,.swal2-container.swal2-grow-column.swal2-center-start,.swal2-container.swal2-grow-column.swal2-top-left,.swal2-container.swal2-grow-column.swal2-top-start{align-items:flex-start}.swal2-container.swal2-grow-column.swal2-bottom-end,.swal2-container.swal2-grow-column.swal2-bottom-right,.swal2-container.swal2-grow-column.swal2-center-end,.swal2-container.swal2-grow-column.swal2-center-right,.swal2-container.swal2-grow-column.swal2-top-end,.swal2-container.swal2-grow-column.swal2-top-right{align-items:flex-end}.swal2-container.swal2-grow-column>.swal2-modal{display:flex!important;flex:1;align-content:center;justify-content:center}.swal2-container:not(.swal2-top):not(.swal2-top-start):not(.swal2-top-end):not(.swal2-top-left):not(.swal2-top-right):not(.swal2-center-start):not(.swal2-center-end):not(.swal2-center-left):not(.swal2-center-right):not(.swal2-bottom):not(.swal2-bottom-start):not(.swal2-bottom-end):not(.swal2-bottom-left):not(.swal2-bottom-right):not(.swal2-grow-fullscreen)>.swal2-modal{margin:auto}@media all and (-ms-high-contrast:none),(-ms-high-contrast:active){.swal2-container .swal2-modal{margin:0!important}}.swal2-container.swal2-fade{transition:background-color .1s}.swal2-container.swal2-shown{background-color:rgba(0,0,0,.4)}.swal2-popup{display:none;position:relative;box-sizing:border-box;flex-direction:column;justify-content:center;width:32em;max-width:100%;padding:1.25em;border:none;border-radius:.3125em;background:#fff;font-family:inherit;font-size:1rem}.swal2-popup:focus{outline:0}.swal2-popup.swal2-loading{overflow-y:hidden}.swal2-header{display:flex;flex-direction:column;align-items:center}.swal2-title{position:relative;max-width:100%;margin:0 0 .4em;padding:0;color:#595959;font-size:1.875em;font-weight:600;text-align:center;text-transform:none;word-wrap:break-word}.swal2-actions{z-index:1;flex-wrap:wrap;align-items:center;justify-content:center;width:100%;margin:1.25em auto 0}.swal2-actions:not(.swal2-loading) .swal2-styled[disabled]{opacity:.4}.swal2-actions:not(.swal2-loading) .swal2-styled:hover{background-image:linear-gradient(rgba(0,0,0,.1),rgba(0,0,0,.1))}.swal2-actions:not(.swal2-loading) .swal2-styled:active{background-image:linear-gradient(rgba(0,0,0,.2),rgba(0,0,0,.2))}.swal2-actions.swal2-loading .swal2-styled.swal2-confirm{box-sizing:border-box;width:2.5em;height:2.5em;margin:.46875em;padding:0;-webkit-animation:swal2-rotate-loading 1.5s linear 0s infinite normal;animation:swal2-rotate-loading 1.5s linear 0s infinite normal;border:.25em solid transparent;border-radius:100%;border-color:transparent;background-color:transparent!important;color:transparent;cursor:default;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.swal2-actions.swal2-loading .swal2-styled.swal2-cancel{margin-right:30px;margin-left:30px}.swal2-actions.swal2-loading :not(.swal2-styled).swal2-confirm::after{content:\"\";display:inline-block;width:15px;height:15px;margin-left:5px;-webkit-animation:swal2-rotate-loading 1.5s linear 0s infinite normal;animation:swal2-rotate-loading 1.5s linear 0s infinite normal;border:3px solid #999;border-radius:50%;border-right-color:transparent;box-shadow:1px 1px 1px #fff}.swal2-styled{margin:.3125em;padding:.625em 2em;box-shadow:none;font-weight:500}.swal2-styled:not([disabled]){cursor:pointer}.swal2-styled.swal2-confirm{border:0;border-radius:.25em;background:initial;background-color:#3085d6;color:#fff;font-size:1.0625em}.swal2-styled.swal2-cancel{border:0;border-radius:.25em;background:initial;background-color:#aaa;color:#fff;font-size:1.0625em}.swal2-styled:focus{outline:0;box-shadow:0 0 0 2px #fff,0 0 0 4px rgba(50,100,150,.4)}.swal2-styled::-moz-focus-inner{border:0}.swal2-footer{justify-content:center;margin:1.25em 0 0;padding:1em 0 0;border-top:1px solid #eee;color:#545454;font-size:1em}.swal2-image{max-width:100%;margin:1.25em auto}.swal2-close{position:absolute;top:0;right:0;justify-content:center;width:1.2em;height:1.2em;padding:0;overflow:hidden;transition:color .1s ease-out;border:none;border-radius:0;outline:initial;background:0 0;color:#ccc;font-family:serif;font-size:2.5em;line-height:1.2;cursor:pointer}.swal2-close:hover{-webkit-transform:none;transform:none;background:0 0;color:#f27474}.swal2-content{z-index:1;justify-content:center;margin:0;padding:0;color:#545454;font-size:1.125em;font-weight:300;line-height:normal;word-wrap:break-word}#swal2-content{text-align:center}.swal2-checkbox,.swal2-file,.swal2-input,.swal2-radio,.swal2-select,.swal2-textarea{margin:1em auto}.swal2-file,.swal2-input,.swal2-textarea{box-sizing:border-box;width:100%;transition:border-color .3s,box-shadow .3s;border:1px solid #d9d9d9;border-radius:.1875em;background:inherit;box-shadow:inset 0 1px 1px rgba(0,0,0,.06);color:inherit;font-size:1.125em}.swal2-file.swal2-inputerror,.swal2-input.swal2-inputerror,.swal2-textarea.swal2-inputerror{border-color:#f27474!important;box-shadow:0 0 2px #f27474!important}.swal2-file:focus,.swal2-input:focus,.swal2-textarea:focus{border:1px solid #b4dbed;outline:0;box-shadow:0 0 3px #c4e6f5}.swal2-file::-webkit-input-placeholder,.swal2-input::-webkit-input-placeholder,.swal2-textarea::-webkit-input-placeholder{color:#ccc}.swal2-file::-moz-placeholder,.swal2-input::-moz-placeholder,.swal2-textarea::-moz-placeholder{color:#ccc}.swal2-file:-ms-input-placeholder,.swal2-input:-ms-input-placeholder,.swal2-textarea:-ms-input-placeholder{color:#ccc}.swal2-file::-ms-input-placeholder,.swal2-input::-ms-input-placeholder,.swal2-textarea::-ms-input-placeholder{color:#ccc}.swal2-file::placeholder,.swal2-input::placeholder,.swal2-textarea::placeholder{color:#ccc}.swal2-range{margin:1em auto;background:inherit}.swal2-range input{width:80%}.swal2-range output{width:20%;color:inherit;font-weight:600;text-align:center}.swal2-range input,.swal2-range output{height:2.625em;padding:0;font-size:1.125em;line-height:2.625em}.swal2-input{height:2.625em;padding:0 .75em}.swal2-input[type=number]{max-width:10em}.swal2-file{background:inherit;font-size:1.125em}.swal2-textarea{height:6.75em;padding:.75em}.swal2-select{min-width:50%;max-width:100%;padding:.375em .625em;background:inherit;color:inherit;font-size:1.125em}.swal2-checkbox,.swal2-radio{align-items:center;justify-content:center;background:inherit;color:inherit}.swal2-checkbox label,.swal2-radio label{margin:0 .6em;font-size:1.125em}.swal2-checkbox input,.swal2-radio input{margin:0 .4em}.swal2-validation-message{display:none;align-items:center;justify-content:center;padding:.625em;overflow:hidden;background:#f0f0f0;color:#666;font-size:1em;font-weight:300}.swal2-validation-message::before{content:\"!\";display:inline-block;width:1.5em;min-width:1.5em;height:1.5em;margin:0 .625em;zoom:normal;border-radius:50%;background-color:#f27474;color:#fff;font-weight:600;line-height:1.5em;text-align:center}@supports (-ms-accelerator:true){.swal2-range input{width:100%!important}.swal2-range output{display:none}}@media all and (-ms-high-contrast:none),(-ms-high-contrast:active){.swal2-range input{width:100%!important}.swal2-range output{display:none}}@-moz-document url-prefix(){.swal2-close:focus{outline:2px solid rgba(50,100,150,.4)}}.swal2-icon{position:relative;box-sizing:content-box;justify-content:center;width:5em;height:5em;margin:1.25em auto 1.875em;zoom:normal;border:.25em solid transparent;border-radius:50%;line-height:5em;cursor:default;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.swal2-icon::before{display:flex;align-items:center;height:92%;font-size:3.75em}.swal2-icon.swal2-error{border-color:#f27474}.swal2-icon.swal2-error .swal2-x-mark{position:relative;flex-grow:1}.swal2-icon.swal2-error [class^=swal2-x-mark-line]{display:block;position:absolute;top:2.3125em;width:2.9375em;height:.3125em;border-radius:.125em;background-color:#f27474}.swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left]{left:1.0625em;-webkit-transform:rotate(45deg);transform:rotate(45deg)}.swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right]{right:1em;-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}.swal2-icon.swal2-warning{border-color:#facea8;color:#f8bb86}.swal2-icon.swal2-warning::before{content:\"!\"}.swal2-icon.swal2-info{border-color:#9de0f6;color:#3fc3ee}.swal2-icon.swal2-info::before{content:\"i\"}.swal2-icon.swal2-question{border-color:#c9dae1;color:#87adbd}.swal2-icon.swal2-question::before{content:\"?\"}.swal2-icon.swal2-question.swal2-arabic-question-mark::before{content:\"؟\"}.swal2-icon.swal2-success{border-color:#a5dc86}.swal2-icon.swal2-success [class^=swal2-success-circular-line]{position:absolute;width:3.75em;height:7.5em;-webkit-transform:rotate(45deg);transform:rotate(45deg);border-radius:50%}.swal2-icon.swal2-success [class^=swal2-success-circular-line][class$=left]{top:-.4375em;left:-2.0635em;-webkit-transform:rotate(-45deg);transform:rotate(-45deg);-webkit-transform-origin:3.75em 3.75em;transform-origin:3.75em 3.75em;border-radius:7.5em 0 0 7.5em}.swal2-icon.swal2-success [class^=swal2-success-circular-line][class$=right]{top:-.6875em;left:1.875em;-webkit-transform:rotate(-45deg);transform:rotate(-45deg);-webkit-transform-origin:0 3.75em;transform-origin:0 3.75em;border-radius:0 7.5em 7.5em 0}.swal2-icon.swal2-success .swal2-success-ring{position:absolute;z-index:2;top:-.25em;left:-.25em;box-sizing:content-box;width:100%;height:100%;border:.25em solid rgba(165,220,134,.3);border-radius:50%}.swal2-icon.swal2-success .swal2-success-fix{position:absolute;z-index:1;top:.5em;left:1.625em;width:.4375em;height:5.625em;-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}.swal2-icon.swal2-success [class^=swal2-success-line]{display:block;position:absolute;z-index:2;height:.3125em;border-radius:.125em;background-color:#a5dc86}.swal2-icon.swal2-success [class^=swal2-success-line][class$=tip]{top:2.875em;left:.875em;width:1.5625em;-webkit-transform:rotate(45deg);transform:rotate(45deg)}.swal2-icon.swal2-success [class^=swal2-success-line][class$=long]{top:2.375em;right:.5em;width:2.9375em;-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}.swal2-progress-steps{align-items:center;margin:0 0 1.25em;padding:0;background:inherit;font-weight:600}.swal2-progress-steps li{display:inline-block;position:relative}.swal2-progress-steps .swal2-progress-step{z-index:20;width:2em;height:2em;border-radius:2em;background:#3085d6;color:#fff;line-height:2em;text-align:center}.swal2-progress-steps .swal2-progress-step.swal2-active-progress-step{background:#3085d6}.swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step{background:#add8e6;color:#fff}.swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step-line{background:#add8e6}.swal2-progress-steps .swal2-progress-step-line{z-index:10;width:2.5em;height:.4em;margin:0 -1px;background:#3085d6}[class^=swal2]{-webkit-tap-highlight-color:transparent}.swal2-show{-webkit-animation:swal2-show .3s;animation:swal2-show .3s}.swal2-show.swal2-noanimation{-webkit-animation:none;animation:none}.swal2-hide{-webkit-animation:swal2-hide .15s forwards;animation:swal2-hide .15s forwards}.swal2-hide.swal2-noanimation{-webkit-animation:none;animation:none}.swal2-rtl .swal2-close{right:auto;left:0}.swal2-animate-success-icon .swal2-success-line-tip{-webkit-animation:swal2-animate-success-line-tip .75s;animation:swal2-animate-success-line-tip .75s}.swal2-animate-success-icon .swal2-success-line-long{-webkit-animation:swal2-animate-success-line-long .75s;animation:swal2-animate-success-line-long .75s}.swal2-animate-success-icon .swal2-success-circular-line-right{-webkit-animation:swal2-rotate-success-circular-line 4.25s ease-in;animation:swal2-rotate-success-circular-line 4.25s ease-in}.swal2-animate-error-icon{-webkit-animation:swal2-animate-error-icon .5s;animation:swal2-animate-error-icon .5s}.swal2-animate-error-icon .swal2-x-mark{-webkit-animation:swal2-animate-error-x-mark .5s;animation:swal2-animate-error-x-mark .5s}@-webkit-keyframes swal2-rotate-loading{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes swal2-rotate-loading{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@media print{body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown){overflow-y:scroll!important}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown)>[aria-hidden=true]{display:none}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) .swal2-container{position:static!important}}");
// version 2.1.4

!function (a) {
  a(["jquery"], function (a) {
    return function () {
      function h(a, b, c) {
        return u({
          type: e.error,
          iconClass: v().iconClasses.error,
          message: a,
          optionsOverride: c,
          title: b
        });
      }
      function i(c, d) {
        return c || (c = v()), b = a("#" + c.containerId), b.length ? b : (d && (b = r(c)), b);
      }
      function j(a, b, c) {
        return u({
          type: e.info,
          iconClass: v().iconClasses.info,
          message: a,
          optionsOverride: c,
          title: b
        });
      }
      function k(a) {
        c = a;
      }
      function l(a, b, c) {
        return u({
          type: e.success,
          iconClass: v().iconClasses.success,
          message: a,
          optionsOverride: c,
          title: b
        });
      }
      function m(a, b, c) {
        return u({
          type: e.warning,
          iconClass: v().iconClasses.warning,
          message: a,
          optionsOverride: c,
          title: b
        });
      }
      function n(a, c) {
        var d = v();
        b || i(d), q(a, d, c) || p(d);
      }
      function o(c) {
        var d = v();
        return b || i(d), c && 0 === a(":focus", c).length ? void w(c) : void (b.children().length && b.remove());
      }
      function p(c) {
        for (var d = b.children(), e = d.length - 1; e >= 0; e--) q(a(d[e]), c);
      }
      function q(b, c, d) {
        var e = !(!d || !d.force) && d.force;
        return !(!b || !e && 0 !== a(":focus", b).length) && (b[c.hideMethod]({
          duration: c.hideDuration,
          easing: c.hideEasing,
          complete: function complete() {
            w(b);
          }
        }), !0);
      }
      function r(c) {
        return b = a("<div/>").attr("id", c.containerId).addClass("toast-container").addClass(c.positionClass), b.appendTo(a(c.target)), b;
      }
      function s() {
        return {
          tapToDismiss: !0,
          toastClass: "toast",
          containerId: "toast-container",
          debug: !1,
          showMethod: "fadeIn",
          showDuration: 300,
          showEasing: "swing",
          onShown: void 0,
          hideMethod: "fadeOut",
          hideDuration: 1e3,
          hideEasing: "swing",
          onHidden: void 0,
          closeMethod: !1,
          closeDuration: !1,
          closeEasing: !1,
          closeOnHover: !0,
          extendedTimeOut: 1e3,
          iconClasses: {
            error: "toast-error",
            info: "toast-info",
            success: "toast-success",
            warning: "toast-warning"
          },
          iconClass: "toast-info",
          positionClass: "toast-top-right",
          timeOut: 5e3,
          titleClass: "toast-title",
          messageClass: "toast-message",
          escapeHtml: !1,
          target: "body",
          closeHtml: '<button type="button">&times;</button>',
          closeClass: "toast-close-button",
          newestOnTop: !0,
          preventDuplicates: !1,
          progressBar: !1,
          progressClass: "toast-progress",
          rtl: !1
        };
      }
      function t(a) {
        c && c(a);
      }
      function u(c) {
        function q(a) {
          return null == a && (a = ""), a.replace(/&/g, "&amp;").replace(/"/g, "&quot;").replace(/'/g, "&#39;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
        }
        function r() {
          y(), A(), B(), C(), D(), E(), z(), s();
        }
        function s() {
          var a = "";
          switch (c.iconClass) {
            case "toast-success":
            case "toast-info":
              a = "polite";
              break;
            default:
              a = "assertive";
          }
          j.attr("aria-live", a);
        }
        function u() {
          e.closeOnHover && j.hover(I, H), !e.onclick && e.tapToDismiss && j.click(G), e.closeButton && n && n.click(function (a) {
            a.stopPropagation ? a.stopPropagation() : void 0 !== a.cancelBubble && a.cancelBubble !== !0 && (a.cancelBubble = !0), e.onCloseClick && e.onCloseClick(a), G(!0);
          }), e.onclick && j.click(function (a) {
            e.onclick(a), G();
          });
        }
        function x() {
          j.hide(), j[e.showMethod]({
            duration: e.showDuration,
            easing: e.showEasing,
            complete: e.onShown
          }), e.timeOut > 0 && (h = setTimeout(G, e.timeOut), o.maxHideTime = parseFloat(e.timeOut), o.hideEta = new Date().getTime() + o.maxHideTime, e.progressBar && (o.intervalId = setInterval(J, 10)));
        }
        function y() {
          c.iconClass && j.addClass(e.toastClass).addClass(f);
        }
        function z() {
          e.newestOnTop ? b.prepend(j) : b.append(j);
        }
        function A() {
          if (c.title) {
            var a = c.title;
            e.escapeHtml && (a = q(c.title)), k.append(a).addClass(e.titleClass), j.append(k);
          }
        }
        function B() {
          if (c.message) {
            var a = c.message;
            e.escapeHtml && (a = q(c.message)), l.append(a).addClass(e.messageClass), j.append(l);
          }
        }
        function C() {
          e.closeButton && (n.addClass(e.closeClass).attr("role", "button"), j.prepend(n));
        }
        function D() {
          e.progressBar && (m.addClass(e.progressClass), j.prepend(m));
        }
        function E() {
          e.rtl && j.addClass("rtl");
        }
        function F(a, b) {
          if (a.preventDuplicates) {
            if (b.message === g) return !0;
            g = b.message;
          }
          return !1;
        }
        function G(b) {
          var c = b && e.closeMethod !== !1 ? e.closeMethod : e.hideMethod,
            d = b && e.closeDuration !== !1 ? e.closeDuration : e.hideDuration,
            f = b && e.closeEasing !== !1 ? e.closeEasing : e.hideEasing;
          if (!a(":focus", j).length || b) return clearTimeout(o.intervalId), j[c]({
            duration: d,
            easing: f,
            complete: function complete() {
              w(j), clearTimeout(h), e.onHidden && "hidden" !== p.state && e.onHidden(), p.state = "hidden", p.endTime = new Date(), t(p);
            }
          });
        }
        function H() {
          (e.timeOut > 0 || e.extendedTimeOut > 0) && (h = setTimeout(G, e.extendedTimeOut), o.maxHideTime = parseFloat(e.extendedTimeOut), o.hideEta = new Date().getTime() + o.maxHideTime);
        }
        function I() {
          clearTimeout(h), o.hideEta = 0, j.stop(!0, !0)[e.showMethod]({
            duration: e.showDuration,
            easing: e.showEasing
          });
        }
        function J() {
          var a = (o.hideEta - new Date().getTime()) / o.maxHideTime * 100;
          m.width(a + "%");
        }
        var e = v(),
          f = c.iconClass || e.iconClass;
        if ("undefined" != typeof c.optionsOverride && (e = a.extend(e, c.optionsOverride), f = c.optionsOverride.iconClass || f), !F(e, c)) {
          d++, b = i(e, !0);
          var h = null,
            j = a("<div/>"),
            k = a("<div/>"),
            l = a("<div/>"),
            m = a("<div/>"),
            n = a(e.closeHtml),
            o = {
              intervalId: null,
              hideEta: null,
              maxHideTime: null
            },
            p = {
              toastId: d,
              state: "visible",
              startTime: new Date(),
              options: e,
              map: c
            };
          return r(), x(), u(), t(p), e.debug && console && console.log(p), j;
        }
      }
      function v() {
        return a.extend({}, s(), f.options);
      }
      function w(a) {
        b || (b = i()), a.is(":visible") || (a.remove(), a = null, 0 === b.children().length && (b.remove(), g = void 0));
      }
      var b,
        c,
        g,
        d = 0,
        e = {
          error: "error",
          info: "info",
          success: "success",
          warning: "warning"
        },
        f = {
          clear: n,
          remove: o,
          error: h,
          getContainer: i,
          info: j,
          options: {},
          subscribe: k,
          success: l,
          version: "2.1.3",
          warning: m
        };
      return f;
    }();
  });
}("function" == typeof define && define.amd ? define : function (a, b) {
  "undefined" != typeof module && module.exports ? module.exports = b(require("jquery")) : window.toastr = b(window.jQuery);
});
$(document).ready(function (l) {
  // **************  fixed header
  $(window).scroll(function () {
    if ($(this).scrollTop() > 60) {
      $('header.main-header.js-fixed-header').addClass('fixed');
      $('header.main-header.js-fixed-topbar').addClass('fixed fixed-topbar');
    } else {
      $('header.main-header.js-fixed-header').removeClass('fixed');
      $('header.main-header.js-fixed-topbar').removeClass('fixed fixed-topbar');
    }
  });

  // **************  category slider
  $('.category-slider').owlCarousel({
    rtl: IS_RTL ? true : false,
    margin: 10,
    nav: true,
    navText: ['<i class="mdi mdi mdi-chevron-right"></i>', '<i class="mdi mdi mdi-chevron-left"></i>'],
    dots: false,
    responsiveClass: true,
    responsive: {
      0: {
        items: 2,
        slideBy: 1
      },
      576: {
        items: 3,
        slideBy: 2
      },
      768: {
        items: 4,
        slideBy: 2
      },
      992: {
        items: 6,
        slideBy: 3
      },
      1400: {
        items: 8,
        slideBy: 4
      }
    }
  });
  // ************** carousel-products
  $('.carousel-products').owlCarousel({
    rtl: IS_RTL ? true : false,
    margin: 10,
    nav: true,
    // autoWidth: true,
    navText: ['<i class="mdi mdi mdi-chevron-right"></i>', '<i class="mdi mdi mdi-chevron-left"></i>'],
    dots: false,
    stagePadding: 1,
    responsiveClass: true,
    responsive: {
      0: {
        items: 3,
        slideBy: 1
      },
      576: {
        items: 4,
        slideBy: 1
      },
      768: {
        items: 6,
        slideBy: 1
      },
      991: {
        items: 7,
        slideBy: 1
      },
      992: {
        items: 3,
        slideBy: 1
      },
      1400: {
        items: 6,
        slideBy: 1
      }
    }
  });

  /* **************  tooltip */
  $('[data-toggle="tooltip"]').tooltip();

  /* **************  product-carousel */
  /* carousel-lg */
  $('.carousel-lg').owlCarousel({
    rtl: IS_RTL ? true : false,
    margin: 10,
    nav: true,
    navText: ['<i class="mdi mdi mdi-chevron-right"></i>', '<i class="mdi mdi mdi-chevron-left"></i>'],
    dots: true,
    responsiveClass: true,
    responsive: {
      0: {
        items: 2,
        slideBy: 1
      },
      480: {
        items: 2,
        slideBy: 1
      },
      576: {
        items: 3,
        slideBy: 1
      },
      768: {
        items: 3,
        slideBy: 2
      },
      992: {
        items: 3,
        slideBy: 2
      },
      1200: {
        items: 4,
        slideBy: 3
      },
      1400: {
        items: 6,
        slideBy: 4
      }
    }
  });
  /* carousel-thumbnails */
  $('.carousel-thumbnails').owlCarousel({
    rtl: IS_RTL ? true : false,
    margin: 10,
    nav: false,
    navText: ['<i class="mdi mdi mdi-chevron-right"></i>', '<i class="mdi mdi mdi-chevron-left"></i>'],
    dots: false,
    responsiveClass: true,
    responsive: {
      0: {
        items: 2,
        slideBy: 1
      },
      480: {
        items: 2,
        slideBy: 1
      },
      576: {
        items: 3,
        slideBy: 1
      },
      768: {
        items: 3,
        slideBy: 1
      },
      992: {
        items: 3,
        slideBy: 1
      },
      1200: {
        items: 4,
        slideBy: 1
      },
      1400: {
        items: 4,
        slideBy: 1
      }
    }
  });

  /* profile-order-steps */
  $('.profile-order-steps').owlCarousel({
    rtl: IS_RTL ? true : false,
    margin: 10,
    nav: true,
    navText: ['<i class="mdi mdi mdi-chevron-right"></i>', '<i class="mdi mdi mdi-chevron-left"></i>'],
    dots: true,
    responsiveClass: true,
    responsive: {
      0: {
        items: 2,
        slideBy: 1
      },
      480: {
        items: 2,
        slideBy: 1
      },
      576: {
        items: 3,
        slideBy: 1
      },
      768: {
        items: 3,
        slideBy: 2
      },
      992: {
        items: 3,
        slideBy: 2
      },
      1200: {
        items: 3,
        slideBy: 3
      },
      1400: {
        items: 3,
        slideBy: 4
      }
    }
  });
  /* carousel-sm */
  $('.carousel-sm').owlCarousel({
    rtl: IS_RTL ? true : false,
    margin: 10,
    nav: true,
    navText: ['<i class="mdi mdi mdi-chevron-right"></i>', '<i class="mdi mdi mdi-chevron-left"></i>'],
    dots: true,
    responsiveClass: true,
    responsive: {
      0: {
        items: 2,
        slideBy: 1
      },
      480: {
        items: 2,
        slideBy: 1
      },
      576: {
        items: 3,
        slideBy: 1
      },
      768: {
        items: 3,
        slideBy: 2
      },
      992: {
        items: 9,
        slideBy: 2
      },
      1200: {
        items: 9,
        slideBy: 3
      },
      1400: {
        items: 7,
        slideBy: 4
      }
    }
  });
  /* carousel-md */
  $('.carousel-md').owlCarousel({
    rtl: IS_RTL ? true : false,
    margin: 10,
    nav: true,
    navText: ['<i class="mdi mdi mdi-chevron-right"></i>', '<i class="mdi mdi mdi-chevron-left"></i>'],
    dots: true,
    responsiveClass: true,
    responsive: {
      0: {
        items: 2,
        slideBy: 1
      },
      480: {
        items: 2,
        slideBy: 1
      },
      576: {
        items: 3,
        slideBy: 1
      },
      768: {
        items: 3,
        slideBy: 2
      },
      992: {
        items: 4,
        slideBy: 2
      },
      1200: {
        items: 4,
        slideBy: 3
      },
      1400: {
        items: 6,
        slideBy: 4
      }
    }
  });

  /* ************** suggestion-slider */
  $('#suggestion-slider').owlCarousel({
    rtl: IS_RTL ? true : false,
    items: 1,
    autoplay: true,
    autoplayTimeout: 5000,
    loop: true,
    dots: true,
    onInitialized: startProgressBar,
    onTranslate: resetProgressBar,
    onTranslated: startProgressBar
  });
  function startProgressBar() {
    // apply keyframe animation
    $('.slide-progress').css({
      width: '100%',
      transition: 'width 5000ms'
    });
  }
  function resetProgressBar() {
    $('.slide-progress').css({
      width: 0,
      transition: 'width 0s'
    });
  }

  /* ************** product-gallery */
  var e = document;
  $('.product-carousel').owlCarousel({
    rtl: IS_RTL ? true : false,
    items: 1,
    loop: false,
    dots: false,
    nav: true,
    navText: ['<i class="mdi mdi mdi-chevron-right"></i>', '<i class="mdi mdi mdi-chevron-left"></i>'],
    onTranslate: function onTranslate(t) {
      var a = t.item.index,
        e = l('.product-gallery .owl-item').eq(a).find('[data-owl]').attr('data-owl');
      l('.product-thumbnails li ').removeClass('active'), l('[href="#' + e + '"]').parent().addClass('active'), l('[data-owl="' + e + '"]').parent().addClass('active');
    }
  });
  if ($.fancybox != undefined) {
    $.fancybox.defaults.hash = false;
    $('.gallery-item').fancybox({
      // hash: true,
      loop: true,
      keyboard: true,
      clickContent: false,
      afterShow: function afterShow(e, b) {
        $(".product-thumbnails .owl-thumbnail[data-slide=\"".concat(e.currIndex, "\"]")).trigger('click');
      }
    });
  }
  $('.owl-thumbnail').click(function (e) {
    e.preventDefault();
    var slide = $(this).data('slide');
    $('.product-gallery .product-carousel').trigger('to.owl.carousel', slide);
  });

  /* ************** sidebar-sticky */
  if ($('.container .sticky-sidebar').length) {
    $('.container .sticky-sidebar').theiaStickySidebar({
      additionalMarginTop: 20
    });
  }

  /* ************** product-params */
  $(document).on('click', '.product-params .sum-more', function () {
    var sumaryBox = $(this).parents('.product-params');
    sumaryBox.toggleClass('active');
    $(this).find('i').toggleClass('active');
    $(this).find('.show-more').fadeToggle(0);
    $(this).find('.show-less').fadeToggle(0);
  });

  /* ************** horizontal-menu */
  $('.ah-tab-wrapper').horizontalmenu({
    itemClick: function itemClick(item) {
      $('.ah-tab-content-wrapper .ah-tab-content').removeAttr('data-ah-tab-active');
      $('.ah-tab-content-wrapper .ah-tab-content:eq(' + $(item).index() + ')').attr('data-ah-tab-active', 'true');
      return false; //if this finction return true then will be executed http request
    }
  });

  /* ************** shopping */
  $('#btn-checkout-contact-location').click(function () {
    $('.checkout-address').addClass('show');
    $('.checkout-contact-content').addClass('hidden');
  });
  $('#cancel-change-address-btn').click(function () {
    $('.checkout-address').removeClass('show');
    $('.checkout-contact-content').removeClass('hidden');
  });

  /* ************** nice-select */
  if ($('.custom-select-ui').length) {
    // customize nice select
    var standardizePersianLetters = function standardizePersianLetters(str) {
      var persianMap = {
        ك: 'ک',
        ي: 'ی',
        ى: 'ی',
        ة: 'ه',
        أ: 'ا',
        إ: 'ا',
        آ: 'ا'
      };
      return str.replace(/[ككيىةأإآ]/g, function (match) {
        return persianMap[match];
      });
    };
    (function ($) {
      $.fn.niceSelect = function (method) {
        // Methods
        if (typeof method == 'string') {
          if (method == 'update') {
            this.each(function () {
              var $select = $(this);
              var $dropdown = $(this).next('.nice-select');
              var open = $dropdown.hasClass('open');
              if ($dropdown.length) {
                $dropdown.remove();
                create_nice_select($select);
                if (open) {
                  $select.next().trigger('click');
                }
              }
            });
          } else if (method == 'destroy') {
            this.each(function () {
              var $select = $(this);
              var $dropdown = $(this).next('.nice-select');
              if ($dropdown.length) {
                $dropdown.remove();
                $select.css('display', '');
              }
            });
            if ($('.nice-select').length == 0) {
              $(document).off('.nice_select');
            }
          } else {
            console.log('Method "' + method + '" does not exist.');
          }
          return this;
        }

        // Hide native select
        this.hide();

        // Create custom markup
        this.each(function () {
          var $select = $(this);
          if (!$select.next().hasClass('nice-select')) {
            create_nice_select($select);
          }
        });
        function create_nice_select($select) {
          $select.after($('<div></div>').addClass('nice-select').addClass($select.attr('class') || '').addClass($select.attr('disabled') ? 'disabled' : '').addClass($select.attr('multiple') ? 'has-multiple' : '').attr('tabindex', $select.attr('disabled') ? null : '0').html($select.attr('multiple') ? '<span class="multiple-options"></span><div class="nice-select-search-box"><input type="text" class="nice-select-search" placeholder="جستجو..."/></div><ul class="list"></ul>' : '<span class="current"></span><div class="nice-select-search-box"><input type="text" class="nice-select-search" placeholder="جستجو..."/></div><ul class="list"></ul>'));
          var $dropdown = $select.next();
          var $options = $select.find('option');
          if ($select.attr('multiple')) {
            var $selected = $select.find('option:selected');
            var $selected_html = '';
            $selected.each(function () {
              $selected_option = $(this);
              $selected_text = $selected_option.data('display') || $selected_option.text();
              if (!$selected_option.val()) {
                return;
              }
              $selected_html += '<span class="current">' + $selected_text + '</span>';
            });
            $select_placeholder = $select.data('js-placeholder') || $select.attr('js-placeholder');
            $select_placeholder = !$select_placeholder ? 'Select' : $select_placeholder;
            $selected_html = $selected_html === '' ? $select_placeholder : $selected_html;
            $dropdown.find('.multiple-options').html($selected_html);
          } else {
            var $selected = $select.find('option:selected');
            $dropdown.find('.current').html($selected.data('display') || $selected.text());
          }
          $options.each(function (i) {
            var $option = $(this);
            var display = $option.data('display');
            $dropdown.find('ul').append($('<li></li>').attr('data-value', $option.val()).attr('data-display', display || null).addClass('option' + ($option.is(':selected') ? ' selected' : '') + ($option.is(':disabled') ? ' disabled' : '')).html($option.text()));
          });
        }

        /* Event listeners */

        // Unbind existing events in case that the plugin has been initialized before
        $(document).off('.nice_select');

        // Open/close
        $(document).on('click.nice_select', '.nice-select', function (event) {
          var $dropdown = $(this);
          $('.nice-select').not($dropdown).removeClass('open');
          $dropdown.toggleClass('open');
          if ($dropdown.hasClass('open')) {
            $dropdown.find('.option');
            $dropdown.find('.nice-select-search').val('');
            $dropdown.find('.nice-select-search').focus();
            $dropdown.find('.focus').removeClass('focus');
            $dropdown.find('.selected').addClass('focus');
            $dropdown.find('ul li').show();
          } else {
            $dropdown.focus();
          }
        });
        $(document).on('click', '.nice-select-search-box', function (event) {
          event.stopPropagation();
          return false;
        });
        $(document).on('keyup.nice-select-search', '.nice-select', function () {
          var $self = $(this);
          var $text = standardizePersianLetters($self.find('.nice-select-search').val().toLowerCase());
          var $options = $self.find('ul li');
          if ($text == '') $options.show();else if ($self.hasClass('open')) {
            var $matchReg = new RegExp($text);
            if (0 < $options.length) {
              $options.each(function () {
                var $this = $(this);
                var $optionText = standardizePersianLetters($this.text().toLowerCase());
                var $matchCheck = $matchReg.test($optionText);
                $matchCheck ? $this.show() : $this.hide();
              });
            } else {
              $options.show();
            }
          }
          $self.find('.option'), $self.find('.focus').removeClass('focus'), $self.find('.selected').addClass('focus');
        });

        // Close when clicking outside
        $(document).on('click.nice_select', function (event) {
          if ($(event.target).closest('.nice-select').length === 0) {
            $('.nice-select').removeClass('open').find('.option');
          }
        });

        // Option click
        $(document).on('click.nice_select', '.nice-select .option:not(.disabled)', function (event) {
          var $option = $(this);
          var $dropdown = $option.closest('.nice-select');
          if ($dropdown.hasClass('has-multiple')) {
            if ($option.hasClass('selected')) {
              $option.removeClass('selected');
            } else {
              $option.addClass('selected');
            }
            $selected_html = '';
            $selected_values = [];
            $dropdown.find('.selected').each(function () {
              $selected_option = $(this);
              var attrValue = $selected_option.data('value');
              var text = $selected_option.data('display') || $selected_option.text();
              $selected_html += "<span class=\"current\" data-id=".concat(attrValue, "> ").concat(text, " <span class=\"remove\">X</span></span>");
              $selected_values.push($selected_option.data('value'));
            });
            $select_placeholder = $dropdown.prev('select').data('js-placeholder') || $dropdown.prev('select').attr('js-placeholder');
            $select_placeholder = !$select_placeholder ? 'Select' : $select_placeholder;
            $selected_html = $selected_html === '' ? $select_placeholder : $selected_html;
            $dropdown.find('.multiple-options').html($selected_html);
            $dropdown.prev('select').val($selected_values).trigger('change');
          } else {
            $dropdown.find('.selected').removeClass('selected');
            $option.addClass('selected');
            var text = $option.data('display') || $option.text();
            $dropdown.find('.current').text(text);
            $dropdown.prev('select').val($option.data('value')).trigger('change');
          }
          console.log($('.mySelect').val());
        });
        //---------remove item
        $(document).on('click', '.remove', function () {
          var $dropdown = $(this).parents('.nice-select');
          var clickedId = $(this).parent().data('id');
          $dropdown.find('.list li').each(function (index, item) {
            if (clickedId == $(item).attr('data-value')) {
              $(item).removeClass('selected');
            }
          });
          $selected_values.forEach(function (item, index, object) {
            if (item === clickedId) {
              object.splice(index, 1);
            }
          });
          $(this).parent().remove();
          console.log($('.mySelect').val());
        });

        // Keyboard events
        $(document).on('keydown.nice_select', '.nice-select', function (event) {
          var $dropdown = $(this);
          var $focused_option = $($dropdown.find('.focus') || $dropdown.find('.list .option.selected'));

          // Space or Enter
          if (event.keyCode == 32 || event.keyCode == 13) {
            if ($dropdown.hasClass('open')) {
              $focused_option.trigger('click');
            } else {
              $dropdown.trigger('click');
            }
            return false;
            // Down
          } else if (event.keyCode == 40) {
            if (!$dropdown.hasClass('open')) {
              $dropdown.trigger('click');
            } else {
              var $next = $focused_option.nextAll('.option:not(.disabled)').first();
              if ($next.length > 0) {
                $dropdown.find('.focus').removeClass('focus');
                $next.addClass('focus');
              }
            }
            return false;
            // Up
          } else if (event.keyCode == 38) {
            if (!$dropdown.hasClass('open')) {
              $dropdown.trigger('click');
            } else {
              var $prev = $focused_option.prevAll('.option:not(.disabled)').first();
              if ($prev.length > 0) {
                $dropdown.find('.focus').removeClass('focus');
                $prev.addClass('focus');
              }
            }
            return false;
            // Esc
          } else if (event.keyCode == 27) {
            if ($dropdown.hasClass('open')) {
              $dropdown.trigger('click');
            }
            // Tab
          } else if (event.keyCode == 9) {
            if ($dropdown.hasClass('open')) {
              return false;
            }
          }
        });

        // Detect CSS pointer-events support, for IE <= 10. From Modernizr.
        var style = document.createElement('a').style;
        style.cssText = 'pointer-events:auto';
        if (style.pointerEvents !== 'auto') {
          $('html').addClass('no-csspointerevents');
        }
        return this;
      };
      $('.custom-select-ui select').niceSelect();
    })(jQuery);
  }

  /* ************** back-to-top */
  $('.back-to-top a').click(function () {
    $('body,html').animate({
      scrollTop: 0
    }, 700);
    return false;
  });

  /* ************** responsive-header */
  $('header.main-header button.btn-menu').click(function () {
    $('header.main-header .side-menu').addClass('open');
    $('header.main-header .overlay-side-menu').addClass('show');
  });
  $('header.main-header .overlay-side-menu.show').click(function () {
    $(this).removeClass('show');
    $('header.main-header .side-menu').removeClass('open');
  });
  $('button.btn-menu').on('click', function () {
    $('.overlay-side-menu').fadeIn(200);
    $('header.main-header .side-menu').addClass('open');
  });
  $('.overlay-side-menu').on('click', function () {
    if ($('header.main-header .side-menu').hasClass('open')) {
      $('header.main-header .side-menu').removeClass('open');
    }
    $(this).fadeOut(200);
  });
  $('header.main-header .side-menu li.active').addClass('open').children('ul').show();
  $('header.main-header .side-menu li.sub-menu> a').on('click', function () {
    $(this).removeAttr('href');
    var e = $(this).parent('li');
    if (e.hasClass('open')) {
      e.removeClass('open');
      e.find('li').removeClass('open');
      e.find('ul').slideUp(400);
    } else {
      e.addClass('open');
      e.children('ul').slideDown(400);
      e.siblings('li').children('ul').slideUp(400);
      e.siblings('li').removeClass('open');
    }
  });

  /* ************** colorswitch */
  if ($('#colorswitch-option').length) {
    $('#colorswitch-option button').on('click', function () {
      $('#colorswitch-option ul').toggleClass('show');
    });
    $('#colorswitch-option ul li').on('click', function () {
      $('#colorswitch-option ul li').removeClass('active');
      $(this).addClass('active');
      var colorPath = $(this).attr('data-path');
      $('#colorswitch').attr('href', colorPath);
    });
  }

  /* ************** megamenu */

  $('.f-menu > li').hover(function () {
    $(this).closest('.list-item').find('.f-menu > li').removeClass('active');
    $(this).addClass('active');
  });
  $('.list-item.list-item-has-children.position-static').hover(function () {
    $('.main-content').append('<div class="trasparent-background"></div>');
    setTimeout(function () {
      $('.trasparent-background').css('opacity', '1');
    }, 20);
  });
  $('.list-item.list-item-has-children.position-static').mouseleave(function () {
    $('.trasparent-background').remove();
  });
  $(document).on('click', '.add-to-cart-single', function () {
    var btn = this;
    $.ajax({
      type: 'POST',
      url: $(btn).data('action'),
      data: {
        quantity: 1
      },
      success: function success(data) {
        if (data.status == 'success') {
          Swal.fire({
            type: 'success',
            title: 'با موفقیت اضافه شد',
            text: 'محصول مورد نظر با موفقیت به سبد خرید شما اضافه شد برای رزرو محصول سفارش خود را نهایی کنید.',
            confirmButtonText: 'باشه',
            footer: '<h5><a href="/cart">مشاهده سبد خرید</a></h5>'
          });
          $('#cart-list-item').replaceWith(data.cart);
        } else {
          Swal.fire({
            type: 'error',
            title: 'خطا',
            text: data.message,
            confirmButtonText: 'باشه',
            footer: '<h5><a href="/cart">مشاهده سبد خرید</a></h5>'
          });
        }
      },
      beforeSend: function beforeSend(xhr) {
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        block(btn.closest('.cart'));
      },
      complete: function complete() {
        unblock(btn.closest('.cart'));
      }
    });
  });
});
function reloadCaptcha() {
  $.ajax({
    url: BASE_URL + '/get-new-captcha',
    type: 'GET',
    data: {},
    success: function success(data) {
      $('img.captcha').attr('src', data.captcha);
    }
  });
}
function block(el) {
  var block_ele = $(el);

  // Block Element
  block_ele.block({
    message: '<div class="mdi mdi-refresh icon-spin text-primary"></div>',
    overlayCSS: {
      backgroundColor: '#fff',
      cursor: 'wait'
    },
    css: {
      border: 0,
      padding: 0,
      backgroundColor: 'none'
    }
  });
}
function unblock(el) {
  $(el).unblock();
  setTimeout(function () {
    $('[data-toggle="popover"]').popover();
  }, 200);
}
$.ajaxSetup({
  error: function error(data) {
    reloadCaptcha();
    if (data.status == 403) {
      toastr.error('اجازه ی دسترسی ندارید', 'خطا', {
        positionClass: 'toast-bottom-left',
        containerId: 'toast-bottom-left'
      });
      return;
    } else if (data.status == 429) {
      toastr.error('تعداد درخواست ها بیش از حد مجاز است لطفا پس از دقایقی مجدد تلاش کنید', 'خطا', {
        positionClass: 'toast-bottom-left',
        containerId: 'toast-bottom-left'
      });
      return;
    } else if (data.status == 401) {
      toastr.error('لطفا وارد حساب کاربری خود شوید', {
        positionClass: 'toast-bottom-left',
        containerId: 'toast-bottom-left'
      });
      return;
    } else if (data.status == 500) {
      toastr.error('خطایی در سرور رخ داده است', 'خطا', {
        positionClass: 'toast-bottom-left',
        containerId: 'toast-bottom-left'
      });
      return;
    } else if (!data.responseJSON.errors) {
      toastr.error('خطایی رخ داده است', 'خطا', {
        positionClass: 'toast-bottom-left',
        containerId: 'toast-bottom-left'
      });
      return;
    }
    for (var key in data.responseJSON.errors) {
      // skip loop if the property is from prototype
      if (!data.responseJSON.errors.hasOwnProperty(key)) continue;
      var obj = data.responseJSON.errors[key];
      for (var prop in obj) {
        // skip loop if the property is from prototype
        if (!obj.hasOwnProperty(prop)) continue;
        toastr.error(obj[prop], 'خطا', {
          positionClass: 'toast-bottom-left',
          containerId: 'toast-bottom-left'
        });
      }
    }
  }
});
$(document).on('click', '#checkout-link', function () {
  $('#checkout-form').trigger('submit');
});
$('[data-toggle="popover"]').popover();
$('#province').change(function () {
  $('#city').empty();
  $('#city').append('<option value="">انتخاب کنید</option>');
  $('#city').trigger('change');
  $('.custom-select-ui select').niceSelect('update');
  if (!$(this).val()) {
    return;
  }
  var id = $(this).find(':selected').val();
  $.ajax({
    type: 'get',
    url: '/province/get-cities',
    data: {
      id: id
    },
    success: function success(data) {
      $(data).each(function () {
        $('#city').append('<option value="' + $(this)[0].id + '">' + $(this)[0].name + '</option>');
      });
      $('.custom-select-ui select').niceSelect('update');
    },
    beforeSend: function beforeSend() {
      //
    }
  });
});

// **************  search
$('header.main-header .search-area form.search input').keyup(delay(function (e) {
  var q = $(this).val();
  q = $.trim(q);
  if (!q) {
    $('header.main-header .search-area form.search .search-result').removeClass('open');
    $('header.main-header .search-area form.search .close-search-result').removeClass('show');
    return;
  }
  $.ajax({
    url: '/search',
    type: 'POST',
    data: {
      q: q
    },
    success: function success(data) {
      $('header.main-header .search-area form.search .search-result').removeClass('open');
      $('header.main-header .search-area form.search .search-result ul').empty();
      $('header.main-header .search-area form.search .close-search-result').removeClass('show');
      if (data.length) {
        $(data).each(function (index, el) {
          $('header.main-header .search-area form.search .search-result ul').append("<li class=\"d-flex p-2 px-3\">\n                                <div>\n                                    <img src=\"".concat(el.image, "\" alt=\"").concat(el.title, "\">\n                                </div>\n                                <div class=\"search-result-text\">\n                                    <div class=\"search-result-body\">\n                                        <a class=\"mr-3\" href=\"").concat(el.link, "\">").concat(el.title, "</a>\n                                        <span class=\"text-muted mr-3\">").concat(el.category, "</span>\n                                    </div>\n                                </div>\n                                <div class=\"box-search-price\">\n                                    <span class=\"ml-3\">").concat(el.price, "</span>\n                                    <a href=\"").concat(el.link, "\" class=\"d-flex align-items-center\">\n                                        <i class=\"mdi mdi-eye text-center search-icon \"></i>\n                                    </a>\n                                </div>\n                            </li>"));
        });
        // Otherwise show it
        $('header.main-header .search-area form.search .search-result').addClass('open');
        $('header.main-header .search-area form.search .close-search-result').addClass('show');
      }
    },
    beforeSend: function beforeSend(xhr) {
      xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
    },
    error: function error() {
      //
    }
  });
}, 300));
$('header.main-header .search-area form.search .close-search-result').on('click', function () {
  $(this).removeClass('show');
  $('header.main-header .search-area form.search .search-result').removeClass('open');
});
function delay(callback, ms) {
  var timer = 0;
  return function () {
    var context = this,
      args = arguments;
    clearTimeout(timer);
    timer = setTimeout(function () {
      callback.apply(context, args);
    }, ms || 0);
  };
}
$('img.captcha').on('click', reloadCaptcha);
if (typeof $.lazyLoadXT != 'undefined') {
  $.lazyLoadXT.onload.addClass = 'animated fadeIn lazyLoadXT-completed';
  $.lazyLoadXT.selector = 'img[data-src]:not(.lazyLoadXT-completed)';
  setInterval(function () {
    $(window).lazyLoadXT();
  }, 1500);
  $(document).on('lazyerror', function (e, el) {
    $(el).attr('data-src', '');
  });
}
function inputFilter(e) {
  var key = e.keyCode || e.which;
  if (!e.shiftKey && !e.altKey && !e.ctrlKey && key >= 48 && key <= 57 || key >= 96 && key <= 105 || key == 8 || key == 9 || key == 13 || key == 37 || key == 39) {} else {
    return false;
  }
  if ($(e.target).val().length > 0) {
    $(e.target).val('');
  }
}
jQuery.fn.activationCodeInput = function (options) {
  var defaults = {
    number: 4,
    length: 1
  };
  var settings = $.extend({}, defaults, options);
  return this.each(function () {
    var self = $(this);
    var activationCode = $('<div />').addClass('activation-code');
    var placeHolder = self.attr('placeholder');
    activationCode.append($('<span />').text(placeHolder));
    self.replaceWith(activationCode);
    activationCode.append(self);
    var activationCodeInputs = $('<div />').addClass('activation-code-inputs');
    for (var i = 1; i <= settings.number; i++) {
      activationCodeInputs.append($('<input />').attr({
        maxLength: settings.length,
        onkeydown: 'return inputFilter(event)',
        oncopy: 'return false',
        onpaste: 'return false',
        oncut: 'return false',
        ondrag: 'return false',
        ondrop: 'return false',
        type: 'number'
      }));
    }
    activationCode.prepend(activationCodeInputs);
    activationCode.on('click touchstart', function (event) {
      if (!activationCode.hasClass('active')) {
        activationCode.addClass('active');
        setTimeout(function () {
          activationCode.find('.activation-code-inputs input:first-child').focus();
        }, 200);
      }
    });
    activationCode.find('.activation-code-inputs').on('keyup input', 'input', function (event) {
      if ($(this).val().toString().length == settings.length || event.keyCode == 39) {
        $(this).next().focus();
        if ($(this).val().toString().length) {
          $(this).css('border-color', '#46b2f0');
        }
      }
      if (event.keyCode == 8 || event.keyCode == 37) {
        $(this).prev().focus();
        if (!$(this).val().toString().length) {
          $(this).css('border-color', '#ccc');
        }
      }
      var value = '';
      activationCode.find('.activation-code-inputs input').each(function () {
        value += $(this).val().toString();
      });
      self.attr({
        value: value
      });
    });
    $(document).on('click touchstart', function (e) {
      if (!$(e.target).parent().is(activationCode) && !$(e.target).is(activationCode) && !$(e.target).parent().parent().is(activationCode)) {
        var hide = true;
        activationCode.find('.activation-code-inputs input').each(function () {
          if ($(this).val().toString().length) {
            hide = false;
          }
        });
        if (hide) {
          activationCode.removeClass('active');
        } else {
          activationCode.addClass('active');
        }
      }
    });
  });
};
function number_format(nStr) {
  nStr += '';
  x = nStr.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  return x1 + x2;
}
var intervals = {};
$('.product-special-end-date').each(function (index, el) {
  // Set the date we're counting down to
  var countDownDate = new Date($(el).data('date')).getTime();

  // Update the count down every 1 second
  var x = setInterval(function () {
    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor(distance % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
    var minutes = Math.floor(distance % (1000 * 60 * 60) / (1000 * 60));
    var seconds = Math.floor(distance % (1000 * 60) / 1000);
    $(el).find('[data-days]').text(days);
    $(el).find('[data-hours]').text(hours);
    $(el).find('[data-minutes]').text(minutes);
    $(el).find('[data-seconds]').text(seconds);

    // If the count down is over, write some text
    if (distance < 0) {
      clearInterval(intervals[index]);
      $(el);
    }
  }, 1000);
  intervals[index] = x;
});
