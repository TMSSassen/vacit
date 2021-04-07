$( document ).ready(function() {
$('#richtext').richText({

  // text formatting
  bold: true,
  italic: true,
  underline: false,

  // text alignment
  leftAlign: false,
  centerAlign: false,
  rightAlign: false,
  justify: false,

  // lists
  ol: false,
  ul: false,

  // title
  heading: false,

  // fonts
  fonts: false,
  fontColor: false,
  fontSize: false,

  // uploads
  imageUpload: false,
  fileUpload: false,

  // media
  videoEmbed: false,

  // link
  urls: false,

  // tables
  table: false,

  // code
  removeStyles: false,
  code: false});
  // Handler for .ready() called.
});