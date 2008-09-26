require "RC/Drivers/rc-ruby/selenium"
require "test/unit"
require "pp"
require "open-uri"
require "cgi"

$host = ARGV[0];
$port = ARGV[1];
$browser = ARGV[2];
$sitetotest = ARGV[3];
$u_id = ARGV[4];
$t_id = ARGV[5];
#$datafile = ARGV[6];

class NewTest < Test::Unit::TestCase
  def setup
    @verification_errors = []
    if $selenium
      @selenium = $selenium
    else
      brows2 = $browser+","+$u_id
      @selenium = Selenium::SeleniumDriver.new($host, $port,brows2, $sitetotest);
      @selenium.start
    end
    @selenium.set_context("test_new")
  end
  
  def teardown
    @selenium.stop unless $selenium
    assert_equal [], @verification_errors
  end
  
  def test_new
    @selenium.open "/"
    @selenium.type "q", "bromine"
    @selenium.click "btnG"
    custom_command("Custom command", "passed", "Does it work?", "Yes!")
    @selenium.wait_for_page_to_load "30000"
    @selenium.click "link=Bromine - Wikipedia, the free encyclopedia"
    @selenium.wait_for_page_to_load "30000"
    custom_command("Custom command", "failed", "true", "false")
    begin
        assert @selenium.is_text_present("Bromine")
    rescue Test::Unit::AssertionFailedError
        @verification_errors << $!
    end
  end
  
  def custom_command(cmdName, status, var1, var2)
    url = "http://127.0.0.1/selenium-server/driver/index.php?cmd=customCommand&cmdName="+CGI.escape(cmdName)+"&status="+CGI.escape(status)+"&var1="+CGI.escape(var1)+"&var2="+CGI.escape(var2)+"&t_id="+CGI.escape($t_id)+"&u_id="+CGI.escape($u_id)
    Kernel.open(url) do |f|
      p f.read
    end
  end


end
