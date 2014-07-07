//start of data
//end of data
var verticalMenu=false;	// true - the main menu runs vertically, false - horizontally
//	After change, modify same values in 1dynamicMenu.css file:
var tdColor="#666666";		// menu item text color
var tdBgColor="#FFFFFF";    //"#E6E6E6";	// menu item background color
var hlColor="#666666";		// highlight text color
var hlBgColor="#FFFFBB";	// highlight background color
var myDelay=250;
var myTimeOutID=-1;
var myMenuData=new Object;
myMenuData=null;
function makeMenu(myTableDataItem){
	clearTimeout(myTimeOutID);
	myTableDataItem.style.backgroundColor=hlBgColor;
	myTableDataItem.style.color=hlColor;
	var i;
	var sMenuItem="";
	var tableDataArray=new Array();
	tableDataArray=myTableDataItem.id.split("_");
	if(myMenuData!=null){
		var menuItemsArray=new Array();
		menuItemsArray=myMenuData.id.split("_");
		for(i=1;i<menuItemsArray.length;i++){
			sMenuItem+="_"+menuItemsArray[i];
			if(menuItemsArray[i]!=tableDataArray[i]){
				document.getElementById("td"+sMenuItem).style.backgroundColor=tdBgColor;
				document.getElementById("td"+sMenuItem).style.color=tdColor;
				if(document.getElementById("tbl"+sMenuItem)!=null)
					document.getElementById("tbl"+sMenuItem).style.visibility="hidden";
			}
		}			
	}
	myMenuData=myTableDataItem;
	sMenuItem="tbl";
	for(i=1;i<tableDataArray.length;i++)
		sMenuItem+="_"+tableDataArray[i];
	if(document.getElementById(sMenuItem)!=null)
		document.getElementById(sMenuItem).style.visibility="visible";

}
function clearMenu(){
	if(myMenuData!=null){
		var menuItemsArray=new Array();
		menuItemsArray=myMenuData.id.split("_");
		var sMenuItem="";
		for(var i=1;i<menuItemsArray.length;i++){
			sMenuItem+="_"+menuItemsArray[i];
			document.getElementById("td"+sMenuItem).style.backgroundColor=tdBgColor;
			document.getElementById("td"+sMenuItem).style.color=tdColor;
			if(document.getElementById("tbl"+sMenuItem)!=null)
				document.getElementById("tbl"+sMenuItem).style.visibility="hidden";
		}
		myMenuData=null;			
	}
}
//go to page
/*function SetCookie (name, value) {  
var argv = SetCookie.arguments;  
var argc = SetCookie.arguments.length;  
var expires = (argc > 2) ? argv[2] : null;  
var path = (argc > 3) ? argv[3] : null;  
var domain = (argc > 4) ? argv[4] : null;  
var secure = (argc > 5) ? argv[5] : false;  
document.cookie = name + "=" + escape (value) + 
((expires == null) ? "" : ("; expires=" + expires.toGMTString())) + 
((path == null) ? "" : ("; path=" + path)) +  
((domain == null) ? "" : ("; domain=" + domain)) +    
((secure == true) ? "; secure" : "");
}
function DeleteCookie (name) {  
var exp = new Date();  
exp.setTime (exp.getTime() - 1);  
var cval = GetCookie (name);  
document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString();
}
*/
function menuGo(theURL){
	theURL=theURL.split("::");
	if(theURL=="?logout=1"){
	DeleteCookie ("frame");
	location.href=theURL[0];
	}
	if(theURL[1]=="content"){
	content.location.href=theURL[0];
    SetCookie ("frame", theURL[0]);//function from mainpage
	}
	else
	{
	location.href=theURL[0];
	}
	roottitle=".:: TIM-A+ Application : ";
	newtitle=theURL[2]!=null?roottitle+theURL[2]:roottitle;
	parent.document.title=newtitle;
}

var tableArrayBuildItem="";
var sMenuItem="";
var myArray=new Array();
var tableArray=new Array();
function getItemPos(st){
	tableArray=st.split("_");
	if(tableArray.length>2){
		tableArray=tableArray.slice(0,-1);
		tableArrayBuildItem=tableArray.join("_");
		return (document.getElementById("tbl"+tableArrayBuildItem).offsetTop+document.getElementById("td"+st).offsetTop+4)+"px;left:"+
			(document.getElementById("tbl"+tableArrayBuildItem).offsetLeft+document.getElementById("td"+st).offsetWidth-2)+"px'>";
	}
	var p1=verticalMenu?document.getElementById("td"+st).offsetTop+4:document.getElementById("td"+st).offsetHeight-2;
	var p2=verticalMenu?document.getElementById("mainmenu").offsetWidth-4:document.getElementById("td"+st).offsetLeft+5;
	return (document.getElementById("mainmenu").offsetTop+p1)+"px;left:"+(document.getElementById("mainmenu").offsetLeft+p2)+"px'>";
}

if(document.getElementById){
var a1=verticalMenu?"":"<tr>";
var a2=verticalMenu?"":"</tr>";
var b1=verticalMenu?"<tr>":"";
var b2=verticalMenu?"</tr>":"";
var b3=verticalMenu?" style='float:left'>":">";
var sTableCode="<table class='menu' id='mainmenu' cellspacing='0'"+b3+a1;
var k=0;
var j=0;
while(eval("typeof(td_"+ ++j +")!='undefined'")){
	sTableCode+=b1+"<td id='td_"+j+"' onmouseover='makeMenu(this)' onmouseout=\"myTimeOutID=setTimeout('clearMenu()',myDelay)\"";
	sTableCode+=(eval("typeof(url_"+j+")!='undefined'"))?" onclick=\"menuGo('"+eval("url_"+j)+"')\">":">";
	sTableCode+=eval("td_"+j)+"</td>"+b2;
	if (eval("typeof(td_"+j+"_1)!='undefined'"))
		myArray[k++]="_"+j;
}
sTableCode+=a2+"</table>";
document.write(sTableCode);
for(var q=0;typeof(myArray[q])!="undefined";q++){
	sMenuItem=myArray[q];
	sTableCode="";
	j=0;
	sTableCode+="<table class='menu' id='tbl"+sMenuItem+"' cellspacing='0' style='top:"+getItemPos(sMenuItem);
	while(eval("typeof(td"+sMenuItem+"_"+ ++j +")!='undefined'")){
		sTableCode+="<tr><td id='td"+sMenuItem+"_"+j+"' onmouseover='makeMenu(this)' onmouseout=\"myTimeOutID=setTimeout('clearMenu()',myDelay)\"";
		sTableCode+=(eval("typeof(url"+sMenuItem+"_"+j+")!='undefined'"))?" onclick=\"menuGo('"+eval("url"+sMenuItem+"_"+j)+"')\">":">";
		sTableCode+=eval("td"+sMenuItem+"_"+j)+"</td></tr>";
		if (eval("typeof(td"+sMenuItem+"_"+j+"_1)!='undefined'"))
			myArray[k++]=sMenuItem+"_"+j;
	}
	sTableCode+="</table>";
	document.write(sTableCode);
}
document.getElementById("mainmenu").style.visibility="visible";
}
else document.write("<p>This code does not work in your browser because it isn't IE5 or Nav6 or better.</p>");
