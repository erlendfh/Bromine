/*

 * Format for Selenium Remote Control Ruby client using Bromine.

 */



load('remoteControl.js');



this.name = "ruby-rc-bromine";



function testMethodName(testName) {

	return "test_" + underscore(testName);

}



function assertTrue(expression) {

	return  "if(" + expression.toString() + " != true)\n"  + 
	indent(1) + "raise('Fejl 40')\n" + 
	"end";

}



function assertFalse(expression) {

	return  "if(" + expression.toString() + " != true)\n"  + 
	indent(1) + "raise('Fejl 40')\n" + 
	"end";
}



function verify(statement) {

	return statement;

}



function verifyTrue(expression) {

	return verify(assertTrue(expression));

}



function verifyFalse(expression) {

	return verify(assertFalse(expression));

}



function assignToVariable(type, variable, expression) {

	return variable + " = " + expression.toString();

}



function waitFor(expression) {

	if (expression.negative) {

		return "assert !60.times{ break unless (" + expression.invert().toString() + " rescue true); sleep 1 }"

	} else {

		return "assert !60.times{ break if (" + expression.toString() + " rescue false); sleep 1 }"

	}

}



function assertOrVerifyFailure(line, isAssert) {

	return "assert_raise(Kernel) { " + line + "}";

}



Equals.prototype.toString = function() {

	return this.e1.toString() + " == " + this.e2.toString();

}

/* Unsupported function */

Equals.prototype.assert = function() {

	return "if(" + this.e1.toString() + " != " + this.e2.toString() + ")\n"  + 
	indent(1) + "raise('Fejl 40')\n" + 
	"end";

}



Equals.prototype.verify = function() {

	return verify(this.assert());

}



NotEquals.prototype.toString = function() {

	return this.e1.toString() + " != " + this.e2.toString();

}

/* Unsupported function */

NotEquals.prototype.assert = function() {

	return "if(" + this.e1.toString() + " == " + this.e2.toString() + ")\n"  + 
	indent(1) + "raise('Fejl 40')\n" + 
	"end";

}



NotEquals.prototype.verify = function() {

	return verify(this.assert());

}



RegexpMatch.prototype.toString = function() {

	return "/" + this.pattern.replace(/\//g, "\\/") + "/ =~ " + this.expression;

}



RegexpNotMatch.prototype.toString = function() {

	return "/" + this.pattern.replace(/\//g, "\\/") + "/ !~ " + this.expression;

}



EqualsArray.useUniqueVariableForAssertion = false;



EqualsArray.prototype.length = function() {

	return this.variableName + ".size";

}



EqualsArray.prototype.item = function(index) {

	return this.variableName + "[" + index + "]";

}



function pause(milliseconds) {

	return "sleep " + (parseInt(milliseconds) / 1000);

}



function echo(message) {

	return "p " + xlateArgument(message);

}



function statement(expression) {

	expression.noBraces = true;

	return expression.toString();

}



function array(value) {

	var str = '[';

	for (var i = 0; i < value.length; i++) {

		str += string(value[i]);

		if (i < value.length - 1) str += ", ";

	}

	str += ']';

	return str;

}



CallSelenium.prototype.toString = function() {

	var result = '';

	if (this.negative) {

		result += '!';

	}

	if (options.receiver) {

		result += options.receiver + '.';

	}

	result += underscore(this.message);

	if (!this.noBraces && this.args.length > 0) {

		result += '(';

	} else if (this.args.length > 0) {

		result += ' ';

	}

	for (var i = 0; i < this.args.length; i++) {

		result += this.args[i];

		if (i < this.args.length - 1) {

			result += ', ';

		}

	}

	if (!this.noBraces && this.args.length > 0) {

		result += ')';

	}

	return result;

}



function formatComment(comment) {

	return comment.comment.replace(/.+/mg, function(str) {

			return "# " + str;

		});

}



this.options = {

	receiver: "@selenium",

	header: 

		'require "../../../Drivers/RC-RUBY/selenium"\n' +

		'require "cgi"\n' +

		'\n' +

		'class ${className}\n' +

		'  def setUp\n' +

		'    cgi = CGI.new\n' +

		'    @selenium = Selenium::SeleniumDriver.new(cgi["host"], cgi["browser"], cgi["sitetotest"],30000 ,"Test Navn", cgi["logFile"]);\n' +

		'    @selenium.start\n' +

		'  end\n' +

		'  \n' +

		'  def tearDown\n' +

		'    @selenium.stop\n' +

		'    return @selenium\n' +

		'  end\n' +

		'  \n' +

		'  def testMyTestCase\n' +

		'    begin\n',

	footer:

		"    rescue\n" +

		"    end\n" +

		"  end\n" +

		"end\n",

	indent: "3",

	initialIndents: "3"

};



this.configForm = 

	'<description>Variable for Selenium instance</description>' +

	'<textbox id="options_receiver" />' +

	'<description>Header</description>' +

	'<textbox id="options_header" multiline="true" flex="1" rows="4"/>' +

	'<description>Footer</description>' +

	'<textbox id="options_footer" multiline="true" flex="1" rows="4"/>' +

	'<description>Indent</description>' +

	'<menulist id="options_indent"><menupopup>' +

	'<menuitem label="Tab" value="tab"/>' +

	'<menuitem label="1 space" value="1"/>' +

	'<menuitem label="2 spaces" value="2"/>' +

	'<menuitem label="3 spaces" value="3"/>' +

	'<menuitem label="4 spaces" value="4"/>' +

	'<menuitem label="5 spaces" value="5"/>' +

	'<menuitem label="6 spaces" value="6"/>' +

	'<menuitem label="7 spaces" value="7"/>' +

	'<menuitem label="8 spaces" value="8"/>' +

	'</menupopup></menulist>';
