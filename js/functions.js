// JavaScript Document
$('#map').click(function(event){
  var x = event.pageX - this.offsetLeft;
  var y = event.pageY - this.offsetTop;

  alert('X: '+x+'  Y:'+y);
});