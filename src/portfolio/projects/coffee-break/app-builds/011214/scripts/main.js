/* main.js */
function redirectTo(value)
{
	window.location.href = value;
}

function executeIntroJSMethods(page)
{
	//introJs().setOption("tooltipPosition", "top");
	introJs().start();
}

function executeWideAreaMethods()
{
	wideArea();
}
