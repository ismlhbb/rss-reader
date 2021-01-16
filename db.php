<?php
// Model page untuk membuat function yang terhubung dengan database
class Database
{
  private $dsn = "mysql:host=localhost;dbname=rssreader"; // ubah dbname sesuai dengan nama database yang dibuat
  private $username = "root";
  private $password = "";
  public $conn;

  // Function untuk membuat koneksi ke database
  public function __construct()
  {
    try {
      $this->conn = new PDO($this->dsn, $this->username, $this->password);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
  // Function untuk membaca data dari database
  public function read()
  {
    $data = array();
    $sql = "SELECT * FROM news_article"; // Mengambil data dari table news_article
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
      $data[] = $row;
    }
    return $data;
  }
  // Function untuk mengambil data untuk detail artikel berdasarkan id
  public function getArticleById($id)
  {
    $sql = "SELECT * FROM news_article WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
  // Function untuk menghitung jumlah data yanga da di database
  public function totalRowCount()
  {
    $sql = "SELECT * FROM news_article";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $t_rows = $stmt->rowCount();
    return $t_rows;
  }
}
