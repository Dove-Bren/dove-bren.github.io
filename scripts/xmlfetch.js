/**************
 *
 * This code adapted from the w3schools tutorial
 * http://www.w3schools.com/xml/xsl_client.asp
 *
 ***************/

function loadXMLDoc(filename)
{
if (window.ActiveXObject)
  {
  xhttp = new ActiveXObject("Msxml2.XMLHTTP");
  }
else
  {
  xhttp = new XMLHttpRequest();
  }
xhttp.open("GET", filename, false);
try {xhttp.responseType = "msxml-document"} catch(err) {} // Helping IE11
// try {xhttp.responseType = "text/xml"} catch(err) {}
xhttp.overrideMimeType("text/xml");
xhttp.send("");
return xhttp.responseXML;
}

function displayResult(id, filename, stylename = ".")
{
if (stylename === ".") {
    stylename = filename;
}
    
xml = loadXMLDoc(filename + ".xml");
xsl = loadXMLDoc(stylename + ".xsl");
// code for IE
if (window.ActiveXObject || xhttp.responseType == "msxml-document")
  {
  ex = xml.transformNode(xsl);
  document.getElementById(id).innerHTML = ex;
  }
// code for Chrome, Firefox, Opera, etc.
else if (document.implementation && document.implementation.createDocument)
  {
  xsltProcessor = new XSLTProcessor();
  xsltProcessor.importStylesheet(xsl);
  resultDocument = xsltProcessor.transformToFragment(xml, document);
  document.getElementById(id).appendChild(resultDocument);
  }
}
