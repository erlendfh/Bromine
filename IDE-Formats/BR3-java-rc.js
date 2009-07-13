/*
 * Format for Selenium Remote Control Java client using Bromine.
 */

load('remoteControl.js');

this.name = "BR3-java-rc";

function useSeparateEqualsForArray() {
	return true;
}

function testMethodName(testName) {
	return "test" + capitalize(testName);
}

function assertTrue(expression) {
	return "assertTrue(" + expression.toString() + ");";
}

function verifyTrue(expression) {
	return "verifyTrue(" + expression.toString() + ");";
}

function assertFalse(expression) {
	return "assertFalse(" + expression.toString() + ");";
}

function verifyFalse(expression) {
	return "verifyFalse(" + expression.toString() + ");";
}

function assignToVariable(type, variable, expression) {
	return type + " " + variable + " = " + expression.toString();
}

function ifCondition(expression, callback) {
    return "if (" + expression.toString() + ") {\n" + callback() + "}";
}

function waitFor(expression) {
	return "for (int second = 0;; second++) {\n" +
		"\tif (second >= 60) fail(\"timeout\");\n" +
		"\ttry { " + (expression.setup ? expression.setup() + " " : "") +
		"if (" + expression.toString() + ") break; } catch (Exception e) {}\n" +
                "\twaiting();\n" +
		"\tThread.sleep(1000);\n" +
		"}\n";
	//return "while (" + not(expression).toString() + ") { Thread.sleep(1000); }";
}

function assertOrVerifyFailure(line, isAssert) {
	var message = '"expected failure"';
    var failStatement = "fail(" + message + ");";
	return "try { " + line + " " + failStatement + " } catch (Throwable e) {}";
}

Equals.prototype.toString = function() {
    if (this.e1.toString().match(/^\d+$/)) {
        // int
	    return this.e1.toString() + " == " + this.e2.toString();
    } else {
        // string
	    return this.e1.toString() + ".equals(" + this.e2.toString() + ")";
    }
}

Equals.prototype.assert = function() {
	return "assertEquals(" + this.e1.toString() + ", " + this.e2.toString() + ");";
}

Equals.prototype.verify = function() {
	return "verifyEquals(" + this.e1.toString() + ", " + this.e2.toString() + ");";
}

NotEquals.prototype.toString = function() {
	return "!" + this.e1.toString() + ".equals(" + this.e2.toString() + ")";
}

NotEquals.prototype.assert = function() {
	return "assertNotEquals(" + this.e1.toString() + ", " + this.e2.toString() + ");";
}

NotEquals.prototype.verify = function() {
	return "verifyNotEquals(" + this.e1.toString() + ", " + this.e2.toString() + ");";
}

RegexpMatch.prototype.toString = function() {
	if (this.pattern.match(/^\^/) && this.pattern.match(/\$$/)) {
		return this.expression + ".matches(" + string(this.pattern) + ")";
	} else {
		return "Pattern.compile(" + string(this.pattern) + ").matcher(" + this.expression + ").find()";
	}
}

seleniumEquals.prototype.length = function() {
	return this.variableName + ".length";
}

seleniumEquals.prototype.item = function(index) {
	return this.variableName + "[" + index + "]";
}

function pause(milliseconds) {
	return "Thread.sleep(" + parseInt(milliseconds) + ");";
}

function echo(message) {
	return "System.out.println(" + xlateArgument(message) + ");";
}

function statement(expression) {
	return expression.toString() + ';';
}

function array(value) {
	var str = 'new String[] {';
	for (var i = 0; i < value.length; i++) {
		str += string(value[i]);
		if (i < value.length - 1) str += ", ";
	}
	str += '}';
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
	result += this.message;
	result += '(';
	for (var i = 0; i < this.args.length; i++) {
		result += this.args[i];
		if (i < this.args.length - 1) {
			result += ', ';
		}
	}
	result += ')';
	return result;
}

function formatComment(comment) {
	return comment.comment.replace(/.+/mg, function(str) {
			return "// " + str;
		});
}

this.options = {
	receiver: "selenium",
	packageName: "com.example.tests",
	superClass: "SeleneseTestCase",
    indent:	'tab',
    initialIndents:	'2'
};

options.header =
	"\n" +
        "import java.io.PrintWriter;\n"+
        "import java.io.StringWriter;\n" +
        "import bromine.brunit.BRUnit;\n" +
    "public class TestNew extends BRUnit {\n" + 
    "\tpublic void ${methodName}() throws Exception {\n";

options.footer =
	"\t}\n" +
        "\tpublic static void main(String[] args) {\n" +
	"\t\ttry{\n"+
        "\t\t\tString host = args[0];\n" +
	"\t\t\tint port = Integer.parseInt(args[1]);\n" +
	"\t\t\tString brows = args[2];\n" +
	"\t\t\tString sitetotest = args[3];\n" +
	"\t\t\tString uid = args[4];\n" +
	"\t\t\tString tid = args[5];\n" +
	"\t\t\tString brows2 = brows+','+uid;\n" +
	"\t\t\tTestNew t = new TestNew();\n" +
	"\t\t\tt.setUp(host, port, brows2, sitetotest, uid, tid);\n" +               
        "\t\t\ttry{\n" +
        "\t\t\t\tt.testNew();\n" +
        "\t\t\t}catch(Exception e){\n"+
        "\t\t\t\tStringWriter sw = new StringWriter();\n" +
        "\t\t\t\tPrintWriter pw = new PrintWriter(sw);\n" +
        "\t\t\t\te.printStackTrace(pw);\n" +
        '\t\t\t\tt.customCommand("An Exception occured in the test", "failed", sw.toString() , "");\n'+
        "\t\t\t}\n" +
	"\t\t\tt.tearDown();\n" +
	"\t\t}\n" +
	"\t\tcatch(Exception e){\n" +
	"\t\t}\n" +
	"\t}\n" +
	"}\n";

this.configForm = 
	'<description>Variable for Selenium instance</description>' +
	'<textbox id="options_receiver" />';

