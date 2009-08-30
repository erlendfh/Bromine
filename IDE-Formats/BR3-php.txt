/**
 * Format for Selenium Remote Control PHP client using Bromine.
 * Thanks to Sonic for the original work.
 */

load('remoteControl.js');

this.name = "BR3-php-rc";

function testMethodName(testName) {
    return "test" + capitalize(testName);
}

function assertTrue(expression) {
    return "$this->assertTrue(" + expression.toString() + ");";
}

function assertFalse(expression) {
    return "$this->assertFalse(" + expression.toString() + ");";
}

function verify(statement) {
    return "try {\n" +
        indent(1) + statement + "\n" +
        "} catch (Exception $e) {}\n";
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
    return "for ($second = 0; ; $second++) {\n" +
        indent(1) + 'if ($second >= 60) $this->fail("timeout");\n' +
        indent(1) + "try {\n" +
        indent(2) + (expression.setup ? expression.setup() + " " : "") +
        indent(2) + "if (" + expression.toString() + ") break;\n" +
        indent(1) + "} catch (Exception $e) {}\n" +
        indent(1) + "sleep(1);\n" +
        "}\n";
}

function assertOrVerifyFailure(line, isAssert) {
    var message = '"expected failure"';
    var failStatement = isAssert ? "$this->fail(" + message  + ");" :
        "array_push($this->verificationErrors, " + message + ");";
    return "try { \n" +
        line + "\n" +
        failStatement + "\n" +
        "} catch (Exception $e) {}\n";
}

Equals.prototype.toString = function() {
    return this.e1.toString() + " == " + this.e2.toString();
}

Equals.prototype.assert = function() {
    return "$this->assertEquals(" + this.e1.toString() + ", " + this.e2.toString() + ");";
}

Equals.prototype.verify = function() {
    return verify(this.assert());
}

NotEquals.prototype.toString = function() {
    return this.e1.toString() + " != " + this.e2.toString();
}

NotEquals.prototype.assert = function() {
    return "$this->assertNotEquals(" + this.e1.toString() + ", " + this.e2.toString() + ");";
}

NotEquals.prototype.verify = function() {
    return verify(this.assert());
}

RegexpMatch.prototype.toString = function() {
  return "(bool)preg_match(/" + this.pattern.replace(/\//g, "\\/") + "/," + this.expression + ");";
}

RegexpNotMatch.prototype.toString = function() {
    return "(bool)preg_match(/" + this.pattern.replace(/\//g, "\\/") + "/," + this.expression + ");";
}

seleniumEquals.prototype.length = function() {
    return this.variableName + ".length";
}

seleniumEquals.prototype.item = function(index) {
    return this.variableName + "[" + index + "]";
}

function pause(milliseconds) {
    return "sleep(" + (parseInt(milliseconds) / 1000) + ");";
}

function echo(message) {
    return "print(" + xlateArgument(message) + ' . "\\n");'
}

function statement(expression) {
    return expression.toString() + ';';
}

function array(value) {
    var str = 'array(';
    for (var i = 0; i < value.length; i++) {
        str += string(value[i]);
        if (i < value.length - 1) str += ", ";
    }
    str += ')';
    return str;
}

CallSelenium.prototype.toString = function() {
    var result = '';
    if (this.negative) {
        result += '!';
    }
    if (options.receiver) {
        result += options.receiver + '->';
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
    receiver: "$this->selenium",
    header: 
        '<?php\n' +
        '\n' +
        'set_include_path(get_include_path() . PATH_SEPARATOR . "drivers/php");\n' +
        "require_once 'Testing/Selenium.php';\n" +
        "require_once 'Testing/BRUnit.php';\n" +
        '\n' +
        'class Example extends BRUnit\n' +
        '{\n' +
        '  function testMyTestCase()\n' +
        '  {\n',

    footer:
        '  }\n' +
        '}\n' +
        'startTest("Example" , $argv);\n' +
        "?>",
    indent: "2",
    initialIndents: '2'
};


this.configForm = 
    '<description>Variable for Selenium instance</description>' +
    '<textbox id="options_receiver" />';
