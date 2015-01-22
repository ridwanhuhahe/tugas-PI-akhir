function validateForm()
		{
		var x=document.forms["log"]["login"].value;
		if (x==null || x=="")
		  {
		  alert("Masukkan username");
		  return false;
		  }
		var y=document.forms["log"]["password"].value;
		if (y==null || y=="")
		  {
		  alert("Masukkan Password");
		  return false;
		  }
		}

		
function toggle(x) 
{
	if(document.getElementById("hidethis"+x+"").style.display=='none' ){
		document.getElementById("hidethis"+x+"").style.display = '';
		document.getElementById("hide"+x+"").style.display = '';
		document.getElementById("hilang"+x+"").style.display = '';
		document.getElementById("nomor"+x+"").style.fontWeight = "bold";
		for (i=1; i<=15; i++)
		{
			if(i==x) {continue;}
			document.getElementById("hidethis"+i+"").style.display = 'none';
			document.getElementById("hide"+i+"").style.display = 'none';
			document.getElementById("hilang"+i+"").style.display = 'none';
			document.getElementById("nomor"+i+"").style.fontWeight = "normal";
		}
	}else{
		for (i=1; i<=15; i++)
		{    
			document.getElementById("hidethis"+i+"").style.display = 'none';
			document.getElementById("hide"+i+"").style.display = 'none';
			document.getElementById("hilang"+i+"").style.display = 'none';
			document.getElementById("nomor"+i+"").style.fontWeight = "normal";
		}
	}
}