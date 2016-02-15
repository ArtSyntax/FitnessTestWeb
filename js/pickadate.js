var myselect = document.getElementById("year"), year = new Date().getFullYear()-59;
var gen = function(max){do{myselect.add(new Option(year++,max--),null);}while(max>0);}(60);