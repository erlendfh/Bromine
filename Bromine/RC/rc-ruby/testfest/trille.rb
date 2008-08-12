require "RC/Drivers/rc-ruby/selenium"
require "test/unit"
require "pp"

$host = ARGV[0];
$port = ARGV[1];
$brows = ARGV[2];
$sitetotest = ARGV[3];
$nodepath = ARGV[4];
$u_id = ARGV[5];
$t_id = ARGV[6];
$brows2 = $brows+','+$nodepath+','+$u_id+','+$t_id;

class NewTest < Test::Unit::TestCase
  def setup
    @verification_errors = []
    if $selenium
      @selenium = $selenium
    else
      @selenium = Selenium::SeleniumDriver.new($host, $port,$brows2, $sitetotest);
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
    @selenium.wait_for_page_to_load "30000"
    @selenium.click "link=Bromine - Wikipedia, the free encyclopedia"
    @selenium.wait_for_page_to_load "30000"
    begin
        assert @selenium.is_text_present("Bromine")
    rescue Test::Unit::AssertionFailedError
        @verification_errors << $!
    end
  end
end
