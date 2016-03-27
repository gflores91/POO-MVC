function __(id){
  return document.getElementById(id);
}

function DeleteItem(content, link){
  var action= window.confirm(content);

  if (action) {
    window.location = link;
  }
}
