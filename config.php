$host = "localhost"; // usually 'localhost' on shared hosting
$dbname = "sms_db"; // from cPanel
$user = "yourdbuser";
$pass = "yourdbpassword";

$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
