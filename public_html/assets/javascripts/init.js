'use strict'

$(document).ready(function() {
var md = window.markdownit({
  html: true,
  linkify: true,
  langPrefix: 'language-',
  typographer: true,
  highlight: function (str, lang) {
    if (lang && hljs.getLanguage(lang)) {
      try {
        return hljs.highlight(lang, str).value;
      } catch (__) {}
    }

    try {
      return hljs.highlightAuto(str).value;
    } catch (__) {}

    return ''; // use external default escaping
  }
});

var source;
  $.get('source/app', function(data) {
    $('#markdown').append(md.render('\n```\n'+data+'\n```\n'));
    $('pre').addClass('hljs');
  });
  document.getElementById('markdown').innerHTML = md.render(document.getElementById('markdown').innerHTML);
});
