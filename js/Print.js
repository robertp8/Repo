/*Author: Robert Peralta */

/*
Allows the user to print out the hazard array information 
*/

function PrintDiv() {
	var tsunData1 = document.getElementById("tsuDesc").innerHTML;
	var tsunData2 = document.getElementById("tsuMit").innerHTML;
	var tsunData3 = document.getElementById("tsuSrc").innerHTML;
	var lavaData1 = document.getElementById("lavaDesc").innerHTML;
	var lavaData2 = document.getElementById("lavaMit").innerHTML;
	var lavaData3 = document.getElementById("lavaSrc").innerHTML;
	var hurrData1 = document.getElementById("hurrDesc").innerHTML;
	var hurrData2 = document.getElementById("hurrMit").innerHTML;
	var hurrData3 = document.getElementById("hurrSrc").innerHTML;
	var frame1 = document.createElement('iframe');
	frame1.name = "frame1";
	frame1.style.position = "absolute";
	frame1.style.top = "-1000000px";
	document.body.appendChild(frame1);
	var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
	frameDoc.document.open();
	frameDoc.document.write('<html><head><title>DIV Contents</title>');
	frameDoc.document.write('</head><body>');
	//frameDoc.document.write(contents);
	frameDoc.document.write('<h1>Tsunami</h1>');
	frameDoc.document.write('<h3>Description</h3>');
	frameDoc.document.write(tsunData1);
	frameDoc.document.write('<h3>Mitigation Data</h3>');
	frameDoc.document.write(tsunData2);
	frameDoc.document.write('<h3>Resources</h3>');
	frameDoc.document.write(tsunData3);
	frameDoc.document.write('<h1>Lava</h1>');
	frameDoc.document.write('<h3>Description</h3>');
	frameDoc.document.write(lavaData1);
	frameDoc.document.write('<h3>Mitigation Data</h3>');
	frameDoc.document.write(lavaData2);
	frameDoc.document.write('<h3>Resources</h3>');
	frameDoc.document.write(lavaData3);
	frameDoc.document.write('<h1>Hurricane</h1>');
	frameDoc.document.write('<h3>Description</h3>');
	frameDoc.document.write(hurrData1);
	frameDoc.document.write('<h3>Mitigation Data</h3>');
	frameDoc.document.write(hurrData2);
	frameDoc.document.write('<h3>Resources</h3>');
	frameDoc.document.write(hurrData3);
	frameDoc.document.write('</body></html>');
	frameDoc.document.close();
	setTimeout(function () {
		window.frames["frame1"].focus();
		window.frames["frame1"].print();
		document.body.removeChild(frame1);
	}, 500);
	return false;
}