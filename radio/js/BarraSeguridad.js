/* 
*  Seguridad de contraseña
*  barra de longitud 
*  generar clave 
*  mostrar y ocultar clave
*
*/

function claveSegura(claveDiv,clave)
{
	this.iniciodivobj = document.getElementById(claveDiv);
	this.objetoClave = clave;

	this.mostrarBarra=_mostrarBarra;

	this.mostrar_pwd=1;
	this.txtMostrar = 'Mostrar';
	this.txtOcultar = 'Ocultar';
	this.txtGenerador = 'Generador';
	this.txtBajo='Bajo';
	this.txtMedio='Medio';
	this.txtAlto='Alto';

	this.activarDemostrar=true;
	this.activarGenerador=true;
	this.activarLongitud=true;
	this.activarLongitudStr=true;

}

function _mostrarBarra()
{
	var code="";
    var clave = this.objetoClave;

	this.pwdfieldid = clave+"_id";

	code += "<input type='password' class='form-control pwdfield' name='"+clave+"' id='"+this.pwdfieldid+"'>";

	this.pwdtxtfield=clave+"_text";

	this.pwdtxtfieldid = this.pwdtxtfield+"_id";

	code += "<input type='text' class='form-control pwdfield' name='"+this.pwdtxtfield+"' id='"+this.pwdtxtfieldid+"' style='display: none;'>";

	this.pwdshowdiv = clave+"_showdiv";

	this.pwdshow_anch = clave + "_show_anch";

	code += "<div class='pwdopsdiv' id='"+this.pwdshowdiv+"'><a href='#' id='"+this.pwdshow_anch+"'>"+this.txtMostrar+"</a></div>";

	this.pwdgendiv = clave+"_gendiv";

	this.pwdgenerate_anch = clave + "_gen_anch";

	code += "<div class='pwdopsdiv'id='"+this.pwdgendiv+"'><a href='#' id='"+this.pwdgenerate_anch+"'>"+this.txtGenerador+"</a></div>";

	this.pwdstrengthdiv = clave + "_strength_div";

	code += "<div class='pwdstrength' id='"+this.pwdstrengthdiv+"'>";

	this.pwdstrengthbar = clave + "_strength_bar";

	code += "<div class='pwdstrengthbar' id='"+this.pwdstrengthbar+"'></div>";

	this.pwdstrengthstr = clave + "_strength_str";

	code += "<div class='pwdstrengthstr' id='"+this.pwdstrengthstr+"'></div>";

	code += "</div>";

	this.iniciodivobj.innerHTML = code;

	this.pwdfieldobj = document.getElementById(this.pwdfieldid);
	
	this.pwdfieldobj.pwdwidget=this;

	this.pwdstrengthbar_obj = document.getElementById(this.pwdstrengthbar);
	
	this.pwdstrengthstr_obj = document.getElementById(this.pwdstrengthstr);

	this._showPasswordStrength = claveStrength;

	this.pwdfieldobj.onkeyup=function(){ this.pwdwidget._onKeyUpPwdFields(); }

	this._showGeneatedPwd = showGeneatedPwd;

	this.generate_anch_obj = document.getElementById(this.pwdgenerate_anch);
	
	this.generate_anch_obj.pwdwidget=this;

	this.generate_anch_obj.onclick = function(){ this.pwdwidget._showGeneatedPwd(); }

	this._showpwdchars = showpwdchars;

	this.show_anch_obj = document.getElementById(this.pwdshow_anch);

	this.show_anch_obj.pwdwidget = this;

	this.show_anch_obj.onclick = function(){ this.pwdwidget._showpwdchars();}

	this.pwdtxtfield_obj = document.getElementById(this.pwdtxtfieldid);

	this.pwdtxtfield_obj.pwdwidget=this;

	this.pwdtxtfield_obj.onkeyup=function(){ this.pwdwidget._onKeyUpPwdFields(); }
	

	this._updatePwdFieldValues = updatePwdFieldValues;

	this._onKeyUpPwdFields=onKeyUpPwdFields;

	if(!this.activarDemostrar)
	{ document.getElementById(this.pwdshowdiv).style.display='none';}

	if(!this.activarGenerador)
	{ document.getElementById(this.pwdgendiv).style.display='none';}

	if(!this.activarLongitud)
	{ document.getElementById(this.pwdstrengthdiv).style.display='none';}

	if(!this.activarLongitudStr)
	{ document.getElementById(this.pwdstrengthstr).style.display='none';}
}

function onKeyUpPwdFields()
{
	this._updatePwdFieldValues(); 
	this._showPasswordStrength();
}

function updatePwdFieldValues()
{
	if(1 == this.mostrar_pwd)
	{
		this.pwdtxtfield_obj.value = this.pwdfieldobj.value;	
	}
	else
	{
		this.pwdfieldobj.value = this.pwdtxtfield_obj.value;
	}
}

function showpwdchars()
{
	var innerText='';
	var pwdfield = this.pwdfieldobj;
	var pwdtxt = this.pwdtxtfield_obj;
	var field;
	if(1 == this.mostrar_pwd)
	{
		this.mostrar_pwd=0;
		innerText = this.txtOcultar;

		pwdtxt.value = pwdfield.value;
		pwdfield.style.display='none';
		pwdtxt.style.display='';
		pwdtxt.focus();
	}
	else
	{
		this.mostrar_pwd=1;
		innerText = this.txtMostrar;	
		pwdfield.value = pwdtxt.value;
		pwdtxt.style.display='none';
		pwdfield.style.display='';
		pwdfield.focus();
			
	}
	this.show_anch_obj.innerHTML = innerText;

}

function claveStrength()
{
	var colors = new Array();
	colors[0] = "#cccccc";
	colors[1] = "#ff0000";
	colors[2] = "#ff5f5f";
	colors[3] = "#56e500";
	colors[4] = "#4dcd00";
	colors[5] = "#399800";

	var pwdfield = this.pwdfieldobj;
	var clave1 = pwdfield.value

	var score   = 0;

	if (clave1.length > 6) {score++;}

	if ( ( clave1.match(/[a-z]/) ) && 
	     ( clave1.match(/[A-Z]/) ) ) {score++;}

	if (clave1.match(/\d+/)){ score++;}

	if ( clave1.match(/[^a-z\d]+/) )	{score++};

	if (clave1.length > 12){ score++;}
	
	var color=colors[score];
	var strengthdiv = this.pwdstrengthbar_obj;
	
	strengthdiv.style.background=colors[score];
	
	if (clave1.length <= 0)
	{ 
		strengthdiv.style.width=0; 
	}
	else
	{
		strengthdiv.style.width=(score+1)*20+'px';
	}

	var desc='';
	if(clave1.length < 1){desc='';}
	else if(score<3){ desc = this.txtBajo; }
	else if(score<4){ desc = this.txtMedio; }
	else if(score>=4){ desc= this.txtAlto; }

	var strengthstrdiv = this.pwdstrengthstr_obj;
	strengthstrdiv.innerHTML = desc;
}

function getRand(max) 
{
	return (Math.floor(Math.random() * max));
}

function shuffleString(mystr)
{
	var arrPwd=mystr.split('');

	for(i=0;i< mystr.length;i++)
	{
		var r1= i;
		var r2=getRand(mystr.length);

		var tmp = arrPwd[r1];
		arrPwd[r1] = arrPwd[r2];
		arrPwd[r2] = tmp;
	}

	return arrPwd.join("");
}

function showGeneatedPwd()
{
	var pwd = generatePWD();
	this.pwdfieldobj.value= pwd;
	this.pwdtxtfield_obj.value =pwd;

	this._showPasswordStrength();
}

function generatePWD()
{
    var maxAlpha = 26;
	var strSymbols="~!@#$%^&*(){}?><`=-|][";
	var clave2='';
	for(i=0;i<3;i++)
	{
		clave2 += String.fromCharCode("a".charCodeAt(0) + getRand(maxAlpha));
	}
	for(i=0;i<3;i++)
	{
		clave2 += String.fromCharCode("A".charCodeAt(0) + getRand(maxAlpha));
	}
	for(i=0;i<3;i++)
	{
		clave2 += String.fromCharCode("0".charCodeAt(0) + getRand(10));
	}
	for(i=0;i<4;i++)
	{
		clave2 += strSymbols.charAt(getRand(strSymbols.length));
	}

	clave2 = shuffleString(clave2);
	clave2 = shuffleString(clave2);
	clave2 = shuffleString(clave2);

	return clave2;
}