function formcheck(){
  if (document.NextPage.Page.value == "" )
        {
        alert("请输入你想要的页数!");
        document.NextPage.Page.focus();
        return false;
        }
	 if (!numericCheck(document.NextPage.Page.value))
        {  
        alert('请输入数字！');
        document.NextPage.Page.value = "";
        document.NextPage.Page.focus();
        return false;
        }	
}
function numericCheck(Isnum){
validity=true
flg=0;
str="";
spc=""
arw="";
for (var i=0;i<Isnum.length;i++){
cmp="0123456789."
tst=Isnum.substring(i,i+1)
if (cmp.indexOf(tst)<0){
flg++;
str+=" "+tst;
spc+=tst;
arw+="^";
}
else{arw+="_";}
}
if (flg!=0){
if (spc.indexOf(" ")>-1) {
str+="和空格";
}
validity=false;
}
return validity;
}
//----------------------------------------去空格-----------------------------------------------------------
function jtrim(sstr)
{
var astr="";
var dstr="";
var flag=0;
for (i=0;i<sstr.length;i++)
    {if ((sstr.charAt(i)!=' ')||(flag!=0)) 
    {dstr+=sstr.charAt(i);
     flag=1;
        }
    }
flag=0;
for (i=dstr.length-1;i>=0;i--)
    {if ((dstr.charAt(i)!=' ')||(flag!=0)) 
    {astr+=dstr.charAt(i);
     flag=1;
        }
    }
dstr="";
for (i=astr.length-1;i>=0;i--) dstr+=astr.charAt(i);
return dstr;
}

//-------------------------------------------找当前对象--------------------------------------------- 
function findObj(n, d) { //v4.0
var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
   if(!x && document.getElementById) x=document.getElementById(n); return x;
}//findObj~~~
 
//-------------------------------------------响应删除选择框事件----------------------------------------          
function EnableBtns(frm,btn,chk)
{
    //
    var i=0;
    var frmObj=document.forms(frm);
    var len=0;
    var btnArray = new Array();
    var indexChk
    
    len=frmObj.elements.length; 
    btnArray=btn.split(",")		
    btnLen=btnArray.length; 
        
    for (i=0;i<btnLen;i++)
    {     
        if (findObj(btnArray[i])!=null) document.all(btnArray[i]).disabled=1  
    } 
    
    for (i=0;i<len;i++)
    { 
        indexChk=frmObj.elements[i].name.indexOf(chk); 
        if (indexChk!= -1)
        {
            if (frmObj.elements[i].checked)
            {
                for (i=0;i<btnLen;i++)
                {     
                    if (findObj(btnArray[i])!=null) document.all(btnArray[i]).disabled=0   
                } 
                return true;
            }
        }
    }
 }//EnableBtns~~
 
 
//----------------------------------------------删除提醒------------------------------------------------------
 
 function DelConfirm(msg)
{
    var confirmmsg=msg
    if (msg!=null) confirmmsg=msg;
    if (window.confirm(confirmmsg)==false)   return false ;
  
 
 }//~~
 
//-----------------------------------------------打开子窗口----------------------------------------------------------
 function OpenWin(url,w,h)
 {
     var win,winstyle;
     winstyle='width='+w+',height='+h;
     win=window.open(url,'','resizable=yes,scrollbars=no,status=no,toolbar=no,menubar=no,location=no,'+winstyle);
     
 }//~~
function winopenx(id,namex)
{
window.open(id,namex,'resizable=yes,scrollbars=yes,toolbar=no,menubar=no,status=no,location=no,width=600,height=420');
}

//-----------------------------------------------关闭子窗口---------------------------------------------------------------
function CloseWin(rf)
{
   if  (rf==1) self.opener.location.reload();
    window.close();
}

//----------------------------------------------------------------------------------------

function AutoHide(f,fArray)
{
var n=document.getElementById(f).style.display.indexOf("block");
var n2Array=new Array();
var n2Len=0;
var n2,i;
  if (n==-1)
      document.getElementById(f).style.display="block"
  else
      document.getElementById(f).style.display="none"
     
  if (fArray!=null)
  {
    n2Array=fArray.split(",")
    n2Len=n2Array.length; 
   
    for(i=0;i<n2Len;i++)
    {   
	  
      //alert(document.getElementById(n2Array[i]).style.display);  
	 
      n2=document.getElementById(n2Array[i]).style.display.indexOf("block");
	  
      if (n2==-1)
          document.getElementById(n2Array[i]).style.display="block";
      else
          document.getElementById(n2Array[i]).style.display="none";
   
    }	   
  }
  

}	

function CheckAll(f,n)
{
    for (var i=0;i<f.elements.length;i++)
	{
	//alert(n);
		if (f.elements[i].name==n)
		   f.elements[i].checked = true;
	}
}

function CancelCheckAll(f,n)
{
    for (var i=0;i<f.elements.length;i++)
	{
	//alert(n);
		if (f.elements[i].name==n)
		    if (f.elements[i].checked == false)
			{
			   f.elements[i].checked = true;
			}else{
			   f.elements[i].checked = false;
			}
		   
	}
} 
 
//------------------------输入框---------------------------------------------
var Objbox=-1
function AutoChangeboxColor(obj,defaultClass,changeClass)
{
  try
  {
      if  (Objbox!=-1){
         Objbox.className=defaultClass;
      }

      if (obj.className==defaultClass)
      {
         obj.className=changeClass;
      }
      else
      {
         obj.className=defaultClass;
      }
    Objbox=obj;
    
  }
  catch(e)
  {
    alert(e)
  }  
}
 
 