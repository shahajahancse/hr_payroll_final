function Insert(field, text) {
    if (document.selection) {
      field.focus();
      sel = document.selection.createRange();
      sel.text = text;
      sel.collapse(true);
      sel.select();
    } else if (field.selectionStart || field.selectionStart == "0") {
      var startPos = field.selectionStart;
      var endPos = field.selectionEnd;
      var scrollTop = field.scrollTop;
      startPos = startPos == -1 ? field.value.length : startPos;
      field.value =
        field.value.substring(0, startPos) +
        text +
        field.value.substring(endPos, field.value.length);
      field.focus();
      field.selectionStart = startPos + text.length;
      field.selectionEnd = startPos + text.length;
      field.scrollTop = scrollTop;
    } else {
      var scrollTop = field.scrollTop;
      field.value += value;
      field.focus();
      field.scrollTop = scrollTop;
    }
  }
  function RemoveNInsert(field, value, len) {
    if (document.selection) {
      field.focus();
      sel = document.selection.createRange();
      if (field.value.length >= len) {
        sel.moveStart("character", -1 * len);
      }
      sel.text = value;
      sel.collapse(true);
      sel.select();
    } else if (field.selectionStart || field.selectionStart == 0) {
      field.focus();
      var startPos = field.selectionStart - len;
      var endPos = field.selectionEnd;
      var scrollTop = field.scrollTop;
      startPos = startPos == -1 ? field.value.length : startPos;
      field.value =
        field.value.substring(0, startPos) +
        value +
        field.value.substring(endPos, field.value.length);
      field.focus();
      field.selectionStart = startPos + value.length;
      field.selectionEnd = startPos + value.length;
      field.scrollTop = scrollTop;
    } else {
      var scrollTop = field.scrollTop;
      field.value += value;
      field.focus();
      field.scrollTop = scrollTop;
    }
  }
  function capsDetect(e) {
    if (!e) e = window.event;
    if (!e) return false;
    var theKey = e.which
      ? e.which
      : e.keyCode
      ? e.keyCode
      : e.charCode
      ? e.charCode
      : 0;
    var theShift = e.shiftKey || (e.modifiers && e.modifiers & 4);
    return (
      (theKey > 64 && theKey < 91 && !theShift) ||
      (theKey > 96 && theKey < 123 && theShift)
    );
  }
  function HideDIV(id) {
    if (document.getElementById) {
      document.getElementById(id).style.display = "none";
    } else {
      if (document.layers) {
        document.id.display = "none";
      } else {
        document.all.id.style.display = "none";
      }
    }
  }
  function ShowDIV(id) {
    if (document.getElementById) {
      document.getElementById(id).style.display = "block";
    } else {
      if (document.layers) {
        document.id.display = "block";
      } else {
        document.all.id.style.display = "block";
      }
    }
  }
  function IsBanglaDigit(CUni) {
    if (
      CUni == "০" ||
      CUni == "১" ||
      CUni == "২" ||
      CUni == "৩" ||
      CUni == "৪" ||
      CUni == "৫" ||
      CUni == "৬" ||
      CUni == "৭" ||
      CUni == "৮" ||
      CUni == "৯"
    )
      return true;
    return false;
  }
  function IsBanglaPreKar(CUni) {
    if (CUni == "ি" || CUni == "ৈ" || CUni == "ে") return true;
    return false;
  }
  function IsBanglaPostKar(CUni) {
    if (
      CUni == "া" ||
      CUni == "ো" ||
      CUni == "ৌ" ||
      CUni == "ৗ" ||
      CUni == "ু" ||
      CUni == "ূ" ||
      CUni == "ী" ||
      CUni == "ৃ"
    )
      return true;
    return false;
  }
  function IsBanglaKar(CUni) {
    if (IsBanglaPreKar(CUni) || IsBanglaPostKar(CUni)) return true;
    return false;
  }
  function IsBanglaBanjonborno(CUni) {
    if (
      CUni == "ক" ||
      CUni == "খ" ||
      CUni == "গ" ||
      CUni == "ঘ" ||
      CUni == "ঙ" ||
      CUni == "চ" ||
      CUni == "ছ" ||
      CUni == "জ" ||
      CUni == "ঝ" ||
      CUni == "ঞ" ||
      CUni == "ট" ||
      CUni == "ঠ" ||
      CUni == "ড" ||
      CUni == "ঢ" ||
      CUni == "ণ" ||
      CUni == "ত" ||
      CUni == "থ" ||
      CUni == "দ" ||
      CUni == "ধ" ||
      CUni == "ন" ||
      CUni == "প" ||
      CUni == "ফ" ||
      CUni == "ব" ||
      CUni == "ভ" ||
      CUni == "ম" ||
      CUni == "শ" ||
      CUni == "ষ" ||
      CUni == "স" ||
      CUni == "হ" ||
      CUni == "য" ||
      CUni == "র" ||
      CUni == "ল" ||
      CUni == "য়" ||
      CUni == "ং" ||
      CUni == "ঃ" ||
      CUni == "ঁ" ||
      CUni == "ৎ"
    )
      return true;
    return false;
  }
  function IsBanglaSoroborno(CUni) {
    if (
      CUni == "অ" ||
      CUni == "আ" ||
      CUni == "ই" ||
      CUni == "ঈ" ||
      CUni == "উ" ||
      CUni == "ঊ" ||
      CUni == "ঋ" ||
      CUni == "ঌ" ||
      CUni == "এ" ||
      CUni == "ঐ" ||
      CUni == "ও" ||
      CUni == "ঔ"
    )
      return true;
    return false;
  }
  function IsBanglaNukta(CUni) {
    if (CUni == "ং" || CUni == "ঃ" || CUni == "ঁ") return true;
    return false;
  }
  function IsBanglaFola(CUni) {
    if (CUni == "্য" || CUni == "্র") return true;
    return false;
  }
  function IsBanglaHalant(CUni) {
    if (CUni == "্") return true;
    return false;
  }
  function IsSpace(C) {
    if (C == " " || C == "\t" || C == "\n" || C == "\r") return true;
    return false;
  }
  function MapKarToSorborno(CUni) {
    var CSorborno = CUni;
    if (CUni == "া") CSorborno = "আ";
    else if (CUni == "ি") CSorborno = "ই";
    else if (CUni == "ী") CSorborno = "ঈ";
    else if (CUni == "ু") CSorborno = "উ";
    else if (CUni == "ূ") CSorborno = "ঊ";
    else if (CUni == "ৃ") CSorborno = "ঋ";
    else if (CUni == "ে") CSorborno = "এ";
    else if (CUni == "ৈ") CSorborno = "ঐ";
    else if (CUni == "ো") CSorborno = "ও";
    else if (CUni == "ো") CSorborno = "ও";
    else if (CUni == "ৌ") CSorborno = "ঔ";
    else if (CUni == "ৌ") CSorborno = "ঔ";
    return CSorborno;
  }
  function MapSorbornoToKar(CUni) {
    var CKar = CUni;
    if (CUni == "আ") CKar = "া";
    else if (CUni == "ই") CKar = "ি";
    else if (CUni == "ঈ") CKar = "ী";
    else if (CUni == "উ") CKar = "ু";
    else if (CUni == "ঊ") CKar = "ূ";
    else if (CUni == "ঋ") CKar = "ৃ";
    else if (CUni == "এ") CKar = "ে";
    else if (CUni == "ঐ") CKar = "ৈ";
    else if (CUni == "ও") CKar = "ো";
    else if (CUni == "ঔ") CKar = "ৌ";
    return CKar;
  }
  
  var uni2bijoy_string_conversion_map = {
    "।": "|",
    "‘": "Ô",
    "’": "Õ",
    "“": "Ò",
    "”": "Ó",
    "্র্য": "ª¨",
    র‌্য: "i¨",
    ক্ক: "°",
    ক্ট: "±",
    ক্ত: "³",
    ক্ব: "K¡",
    স্ক্র: "¯Œ",
    ক্র: "µ",
    ক্ল: "K¬",
    ক্ষ: "¶",
    ক্স: "·",
    গু: "¸",
    গ্ধ: "»",
    গ্ন: "Mœ",
    গ্ম: "M¥",
    গ্ল: "M­",
    গ্রু: "Mªy",
    ঙ্ক: "¼",
    ঙ্ক্ষ: "•¶",
    ঙ্খ: "•L",
    ঙ্গ: "½",
    ঙ্ঘ: "•N",
    চ্চ: "”P",
    চ্ছ: "”Q",
    চ্ছ্ব: "”Q¡",
    চ্ঞ: "”T",
    জ্জ্ব: "¾¡",
    জ্জ: "¾",
    জ্ঝ: "À",
    জ্ঞ: "Á",
    জ্ব: "R¡",
    ঞ্চ: "Â",
    ঞ্ছ: "Ã",
    ঞ্জ: "Ä",
    ঞ্ঝ: "Å",
    ট্ট: "Æ",
    ট্ব: "U¡",
    ট্ম: "U¥",
    ড্ড: "Ç",
    ণ্ট: "È",
    ণ্ঠ: "É",
    ন্স: "Ý",
    ণ্ড: "Ê",
    ন্তু: "š‘",
    ণ্ব: "Y^",
    ত্ত: "Ë",
    ত্ত্ব: "Ë¡",
    ত্থ: "Ì",
    ত্ন: "Zœ",
    ত্ম: "Z¥",
    ন্ত্ব: "š—¡",
    ত্ব: "Z¡",
    থ্ব: "_¡",
    দ্গ: "˜M",
    দ্ঘ: "˜N",
    দ্দ: "Ï",
    দ্ধ: "×",
    দ্ব: "˜¡",
    দ্ব: "Ø",
    দ্ভ: "™¢",
    দ্ম: "Ù",
    দ্রু: "`ª“",
    ধ্ব: "aŸ",
    ধ্ম: "a¥",
    ন্ট: "›U",
    ন্ঠ: "Ú",
    ন্ড: "Û",
    ন্ত্র: "š¿",
    ন্ত: "š—",
    স্ত্র: "¯¿",
    ত্র: "Î",
    ন্থ: "š’",
    ন্দ: "›`",
    ন্দ্ব: "›Ø",
    ন্ধ: "Ü",
    ন্ন: "bœ",
    ন্ব: "š^",
    ন্ম: "b¥",
    প্ট: "Þ",
    প্ত: "ß",
    প্ন: "cœ",
    প্প: "à",
    প্ল: "c­",
    প্স: "á",
    ফ্ল: "d¬",
    ব্জ: "â",
    ব্দ: "ã",
    ব্ধ: "ä",
    ব্ব: "eŸ",
    ব্ল: "e­",
    ভ্র: "å",
    ম্ন: "gœ",
    ম্প: "¤ú",
    ম্ফ: "ç",
    ম্ব: "¤^",
    ম্ভ: "¤¢",
    ম্ভ্র: "¤£",
    ম্ম: "¤§",
    ম্ল: "¤­",
    রু: "i“",
    রূ: "iƒ",
    ল্ক: "é",
    ল্গ: "ê",
    ল্প: "í",
    ল্ট: "ë",
    ল্ড: "ì",
    ল্ফ: "î",
    ল্ব: "j¦",
    ল্ম: "j¥",
    ল্ল: "jø",
    শু: "ï",
    শ্চ: "ð",
    শ্ন: "kœ",
    শ্ব: "k¦",
    শ্ম: "k¥",
    শ্ল: "kø",
    ষ্ক: "®‹",
    ষ্ক্র: "®Œ",
    ষ্ট: "ó",
    ষ্ঠ: "ô",
    ষ্ণ: "ò",
    ষ্প: "®ú",
    ষ্ফ: "õ",
    ষ্ম: "®§",
    স্ক: "¯‹",
    স্ট: "÷",
    স্খ: "ö",
    স্ত: "¯—",
    স্তু: "¯‘",
    স্থ: "¯’",
    স্ন: "mœ",
    স্প: "¯ú",
    স্ফ: "ù",
    স্ব: "¯^",
    স্ম: "¯§",
    স্ল: "¯­",
    হু: "û",
    হ্ণ: "nè",
    হ্ন: "ý",
    হ্ম: "þ",
    হ্ল: "n¬",
    হৃ: "ü",
    র্: "©",
    "্র": "«",
    "্য": "¨",
    "্": "&",
    আ: "Av",
    অ: "A",
    ই: "B",
    ঈ: "C",
    উ: "D",
    ঊ: "E",
    ঋ: "F",
    এ: "G",
    ঐ: "H",
    ও: "I",
    ঔ: "J",
    ক: "K",
    খ: "L",
    গ: "M",
    ঘ: "N",
    ঙ: "O",
    চ: "P",
    ছ: "Q",
    জ: "R",
    ঝ: "S",
    ঞ: "T",
    ট: "U",
    ঠ: "V",
    ড: "W",
    ঢ: "X",
    ণ: "Y",
    ত: "Z",
    থ: "_",
    দ: "`",
    ধ: "a",
    ন: "b",
    প: "c",
    ফ: "d",
    ব: "e",
    ভ: "f",
    ম: "g",
    য: "h",
    র: "i",
    ল: "j",
    শ: "k",
    ষ: "l",
    স: "m",
    হ: "n",
    ড়: "o",
    ঢ়: "p",
    য়: "q",
    ৎ: "r",
    "০": "0",
    "১": "1",
    "২": "2",
    "৩": "3",
    "৪": "4",
    "৫": "5",
    "৬": "6",
    "৭": "7",
    "৮": "8",
    "৯": "9",
    "া": "v",
    "ি": "w",
    "ী": "x",
    "ু": "y",
    "ূ": "~",
    "ৃ": "…",
    "ে": "‡",
    "ৈ": "‰",
    "ৗ": "Š",
    "ং": "s",
    "ঃ": "t",
    "ঁ": "u",
  };
  var uni2somewherein_string_conversion_map = {
    "।": "|",
    "‘": "Ô",
    "’": "Õ",
    "“": "Ò",
    "”": "Ó",
    "্র্য": "ª¨",
    র‌্য: "i¨",
    ক্ক: "°",
    ক্ট: "±",
    ক্ত: "³",
    ক্ব: "K¡",
    স্ক্র: "¯Œ",
    ক্র: "µ",
    ক্ল: "K¬",
    ক্ষ: "¶",
    ক্স: "·",
    গু: "¸",
    গ্ধ: "»",
    গ্ন: "Mœ",
    গ্ম: "M¥",
    গ্ল: "M­",
    গ্রু: "Mªy",
    ঙ্ক: "¼",
    ঙ্ক্ষ: "•¶",
    ঙ্খ: "•L",
    ঙ্গ: "½",
    ঙ্ঘ: "•N",
    চ্চ: "”P",
    চ্ছ: "”Q",
    চ্ছ্ব: "”Q¡",
    চ্ঞ: "”T",
    জ্জ্ব: "¾¡",
    জ্জ: "¾",
    জ্ঝ: "À",
    জ্ঞ: "Á",
    জ্ব: "R¡",
    ঞ্চ: "Â",
    ঞ্ছ: "Ã",
    ঞ্জ: "Ä",
    ঞ্ঝ: "Å",
    ট্ট: "Æ",
    ট্ব: "U¡",
    ট্ম: "U¥",
    ড্ড: "Ç",
    ণ্ট: "È",
    ণ্ঠ: "É",
    ন্স: "Ý",
    ণ্ড: "Ê",
    ন্তু: "š‘",
    ণ্ব: "Y^",
    ত্ত: "Ë",
    ত্ত্ব: "Ë¡",
    ত্থ: "Ì",
    ত্ম: "Z¥",
    ত্ন: "Zœ",
    ন্ত্ব: "š—¡",
    ত্ব: "Z¡",
    থ্ব: "_¡",
    দ্গ: "˜M",
    দ্ঘ: "˜N",
    দ্দ: "Ï",
    দ্ধ: "×",
    দ্ব: "˜¡",
    দ্ব: "Ø",
    দ্ভ: "™¢",
    দ্ম: "Ù",
    দ্রু: "`ª“",
    ধ্ব: "aŸ",
    ধ্ম: "a¥",
    ন্ট: "›U",
    ন্ড: "Û",
    ন্ত্র: "š¿",
    ন্ত: "š—",
    স্ত্র: "¯¿",
    ত্র: "Î",
    ন্থ: "š’",
    ন্দ: "›`",
    ন্দ্ব: "›Ø",
    ন্ধ: "Ü",
    ন্ন: "bœ",
    ন্ব: "š^",
    ন্ম: "b¥",
    প্ট: "Þ",
    প্ত: "ß",
    প্ন: "cœ",
    প্প: "à",
    প্ল: "c­",
    প্স: "á",
    ফ্ল: "d¬",
    ব্জ: "â",
    ব্দ: "ã",
    ব্ধ: "ä",
    ব্ব: "eŸ",
    ব্ল: "e­",
    ভ্র: "å",
    ম্ন: "gœ",
    ম্প: "¤ú",
    ম্ফ: "ç",
    ম্ব: "¤^",
    ম্ভ: "¤¢",
    ম্ভ্র: "¤£",
    ম্ম: "¤§",
    ম্ল: "¤­",
    রু: "i“",
    রূ: "iƒ",
    ল্ক: "é",
    ল্গ: "ê",
    ল্ট: "ë",
    ল্ড: "ì",
    ল্প: "í",
    ল্ফ: "î",
    ল্ব: "j¦",
    ল্ম: "j¥",
    ল্ল: "j­",
    শু: "ï",
    শ্চ: "ð",
    শ্ন: "kœ",
    শ্ব: "k¦",
    শ্ম: "k¥",
    শ্ল: "k­",
    ষ্ক: "®‹",
    ষ্ক্র: "®Œ",
    ষ্ট: "ó",
    ষ্ঠ: "ô",
    ষ্ণ: "ò",
    ষ্প: "®ú",
    ষ্ফ: "õ",
    ষ্ম: "®§",
    স্ক: "¯‹",
    স্ট: "÷",
    স্খ: "ö",
    স্ত: "¯—",
    স্তু: "¯‘",
    স্থ: "¯’",
    স্ন: "mœ",
    স্প: "¯ú",
    স্ফ: "ù",
    স্ব: "¯^",
    স্ম: "¯§",
    স্ল: "¯­",
    হ্ণ: "nè",
    হ্ন: "ý",
    হ্ম: "þ",
    হু: "û",
    হ্ল: "n¬",
    হৃ: "ü",
    র্: "©",
    "্র": "Ö",
    "্য": "¨",
    "্": "&",
    আ: "Av",
    অ: "A",
    ই: "B",
    ঈ: "C",
    উ: "D",
    ঊ: "E",
    ঋ: "F",
    এ: "G",
    ঐ: "H",
    ও: "I",
    ঔ: "J",
    ক: "K",
    খ: "L",
    গ: "M",
    ঘ: "N",
    ঙ: "O",
    চ: "P",
    ছ: "Q",
    জ: "R",
    ঝ: "S",
    ঞ: "T",
    ট: "U",
    ঠ: "V",
    ড: "W",
    ঢ: "X",
    ণ: "Y",
    ত: "Z",
    থ: "_",
    দ: "`",
    ধ: "a",
    ন: "b",
    প: "c",
    ফ: "d",
    ব: "e",
    ভ: "f",
    ম: "g",
    য: "h",
    র: "i",
    ল: "j",
    শ: "k",
    ষ: "l",
    স: "m",
    হ: "n",
    ড়: "o",
    ঢ়: "p",
    য়: "q",
    ৎ: "r",
    "০": "0",
    "১": "1",
    "২": "2",
    "৩": "3",
    "৪": "4",
    "৫": "5",
    "৬": "6",
    "৭": "7",
    "৮": "8",
    "৯": "9",
    "া": "v",
    "ি": "w",
    "ী": "x",
    "ু": "y",
    "ূ": "~",
    "ৃ": "„",
    "ে": "‡",
    "ৈ": "‰",
    "ৗ": "Š",
    "ং": "s",
    "ঃ": "t",
    "ঁ": "u",
  };
  var uni2boisakhi_string_conversion_map = {
    "্র্য": "Ûø",
    র‌্য: "kø",
    ক্ক: "~",
    ক্ট: "ƒ",
    ক্ত: "£ß",
    ক্ব: "Kò",
    স্ক্র: "Ç",
    ক্র: "¢ß",
    ক্ষ্ম: "qô",
    ক্ষ: "q",
    ক্স: "…",
    ক্ল: "Kõ",
    গু: "†",
    গ্গ: "‡",
    গ্ধ: "ˆ",
    গ্ন: "Mí",
    গ্ম: "Mô",
    গ্ল: "Mö",
    ঙ্ক: "‰",
    ঙ্ক্ষ: "áq",
    ঙ্খ: "áL",
    ঙ্গ: "Š",
    ঙ্ঘ: "áN",
    চ্চ: "âP",
    চ্ছ: "âQ",
    চ্ছ্ব: "âQò",
    জ্জ্ব: "Œò",
    জ্জ: "Œ",
    জ্ঞ: "š",
    জ্ব: "Rò",
    ঞ্চ: "é",
    "˜": "ঞ্ছ",
    ঞ্জ: "™",
    ঞ্ঝ: "ã",
    ট্ট: "›",
    ট্ব: "Uò",
    ট্ম: "Uô",
    ড্ড: "œ",
    ণ্ঠ: "Ÿ",
    ন্ঠ: "ª",
    ন্স: "Ý",
    ণ্ড: "¡",
    ন্তু: "š‘",
    ন্তু: "ìç",
    ণ্ব: "Yð",
    ত্ত্ব: "£ò",
    ত্থ: "¤",
    ত্ন: "Zí",
    ত্ম: "£ô",
    ত্ম: "Zô",
    ত্ত: "£",
    ন্ত্ব: "ìòæ",
    ত্ব: "Zò",
    থ্ব: "aò",
    দ্দ: "¥",
    দ্ধ: "¦",
    দ্ব: "§",
    দ্ভ: "¨",
    দ্ম: "bô",
    ধ্ব: "cµ",
    ন্ট: "ëU",
    ন্ট: "åU",
    ন্ড: "«",
    ন্ত্র: "ìè",
    ন্ত: "ìæ",
    স্ত্র: "þè",
    ত্র: "¢",
    ন্দ: "ëb",
    ন্দ্ব: "ë§",
    ন্ধ: "¬",
    ন্ধ: "ëc",
    ন্ন: "Ò",
    ন্ন: "dí",
    ন্ব: "ìñ",
    ন্থ: "ìÿ",
    ন্ম: "dô",
    ন্স: "ëo",
    প্ট: "ïU",
    প্ত: "®",
    প্ন: "eí",
    প্প: "¯",
    প্ল: "eö",
    ফ্ল: "d¬",
    ব্জ: "±",
    ব্দ: "²",
    ব্ধ: "³",
    ব্ব: "gµ",
    ব্ল: "gö",
    ম্ভ্র: "»",
    ভ্র: "¸",
    ম্ন: "ií",
    ম্প: "óe",
    ম্ফ: "óf",
    ম্ব: "¹",
    ম্ভ: "º",
    ম্ম: "ói",
    ম্ল: "óö",
    ল্ক: "¿",
    ল্গ: "ùM",
    ল্ট: "ùU",
    ল্ড: "À",
    ল্প: "ùe",
    ল্ফ: "ùf",
    ল্ব: "lð",
    ল্ম: "lô",
    ল্ল: "Á",
    শু: "Â",
    শ্চ: "úP",
    শ্ন: "mí",
    শ্ব: "mð",
    শ্ম: "mô",
    শ্ল: "mö",
    ষ্ক: "ûK",
    ষ্ক্র: "û¢ß",
    ষ্ট: "Ä",
    ষ্ঠ: "Å",
    ষ্প: "ûe",
    ষ্ফ: "üf",
    ষ্ম: "ûô",
    স্ক: "Æ",
    স্খ: "ýL",
    স্ট: "ýU",
    স্থ: "þÿ",
    স্ত: "þæ",
    স্তু: "þç",
    স্ন: "þí",
    স্প: "þe",
    স্ফ: "ýf",
    স্ব: "È",
    স্ব: "þñ",
    স্ম: "þô",
    হু: "É",
    হ্ণ: "pî",
    হ্ন: "pß",
    হ্ম: "Ê",
    হ্ল: "n¬",
    হ্ল: "põ",
    হৃ: "pÕ",
    ব: "ò",
    র্: "ê",
    "্র": "Þ",
    "্য": "ø",
    "্": "z",
    আ: "Aw",
    অ: "A",
    ই: "B",
    ঈ: "C",
    উ: "D",
    ঊ: "E",
    ঋ: "F",
    এ: "G",
    ঐ: "H",
    ও: "I",
    ঔ: "J",
    ক: "K",
    খ: "L",
    গ: "M",
    ঘ: "N",
    ঙ: "O",
    চ: "P",
    ছ: "Q",
    জ: "R",
    ঝ: "S",
    ঞ: "T",
    ট: "U",
    ঠ: "V",
    ড: "W",
    ঢ: "X",
    ণ: "Y",
    ত: "Z",
    থ: "¤",
    দ: "b",
    ধ: "c",
    ন: "d",
    প: "e",
    ফ: "f",
    ব: "g",
    ভ: "h",
    ম: "i",
    য: "j",
    র: "k",
    ল: "l",
    শ: "m",
    ষ: "n",
    স: "o",
    হ: "p",
    ড়: "r",
    ঢ়: "s",
    য়: "t",
    থ: "a",
    ৎ: "u",
    "ং": "v",
    "ঁ": "^",
    "০": "0",
    "১": "1",
    "২": "2",
    "৩": "3",
    "৪": "4",
    "৫": "5",
    "৬": "6",
    "৭": "7",
    "৮": "8",
    "৯": "9",
    "া": "w",
    "ি": "x",
    "ী": "y",
    "ু": "×",
    "ূ": "Ô",
    "ৃ": "Ú",
    "ে": "Ë",
    "ৈ": "Ð",
    "ৗ": "#",
    "।": "„",
  };
  function ReArrangeUnicodeText(str) {
    var barrier = 0;
    for (var i = 0; i < str.length; i++) {
      if (i < str.length && IsBanglaPreKar(str.charAt(i))) {
        var j = 1;
        while (IsBanglaBanjonborno(str.charAt(i - j))) {
          if (i - j < 0) break;
          if (i - j <= barrier) break;
          if (IsBanglaHalant(str.charAt(i - j - 1))) j += 2;
          else break;
        }
        var temp = str.substring(0, i - j);
        temp += str.charAt(i);
        temp += str.substring(i - j, i);
        temp += str.substring(i + 1, str.length);
        str = temp;
        barrier = i + 1;
        continue;
      }
      if (
        i < str.length - 1 &&
        IsBanglaHalant(str.charAt(i)) &&
        str.charAt(i - 1) == "র" &&
        !IsBanglaHalant(str.charAt(i - 2))
      ) {
        var j = 1;
        var found_pre_kar = 0;
        while (true) {
          if (
            IsBanglaBanjonborno(str.charAt(i + j)) &&
            IsBanglaHalant(str.charAt(i + j + 1))
          )
            j += 2;
          else if (
            IsBanglaBanjonborno(str.charAt(i + j)) &&
            IsBanglaPreKar(str.charAt(i + j + 1))
          ) {
            found_pre_kar = 1;
            break;
          } else break;
        }
        var temp = str.substring(0, i - 1);
        temp += str.substring(i + j + 1, i + j + found_pre_kar + 1);
        temp += str.substring(i + 1, i + j + 1);
        temp += str.charAt(i - 1);
        temp += str.charAt(i);
        temp += str.substring(i + j + found_pre_kar + 1, str.length);
        str = temp;
        i += j + found_pre_kar;
        barrier = i + 1;
        continue;
      }
    }
    return str;
  }
  function ConvertToASCII(ConvertTo, line) {
    var conversion_map = uni2bijoy_string_conversion_map;
    if (ConvertTo == "bijoy") conversion_map = uni2bijoy_string_conversion_map;
    else if (ConvertTo == "somewherein")
      conversion_map = uni2somewherein_string_conversion_map;
    else if (ConvertTo == "boisakhi")
      conversion_map = uni2boisakhi_string_conversion_map;
    var myRegExp;
    myRegExp = new RegExp("ো", "g");
    line = line.replace(myRegExp, "ো");
    myRegExp = new RegExp("ৌ", "g");
    line = line.replace(myRegExp, "ৌ");
    line = ReArrangeUnicodeText(line);
    for (var unic in conversion_map) {
      myRegExp = new RegExp(unic, "g");
      line = line.replace(myRegExp, conversion_map[unic]);
    }
    return line;
  }
  
  function applyUnicodeToBijoy() {
    document.querySelectorAll(".unicode-to-bijoy").forEach((el) => {
      el.style.fontFamily = "SutonnyMJ";
      el.textContent = ConvertToASCII("bijoy", el.textContent);
      console.log(el.textContent);
    });
  }
  