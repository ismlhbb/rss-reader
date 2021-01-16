<?php
// Controller Page
require_once 'db.php';
$db = new Database();
$rss = new DOMDocument();
$rss->load('https://www.vice.com/id/rss?locale=id_id'); // Mengambil data rss dari portal berita vice.com
$feeds = array();
// mengubah data rss berdasarkan tagname dan melakukan push ke dalam array
foreach ($rss->getElementsByTagName('item') as $node) {
    $item = array(
        'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
        'url' => $node->getElementsByTagName('link')->item(0)->nodeValue,
        'content' => $node->getElementsByTagName('encoded')->item(0)->nodeValue,
        'summary' => $node->getElementsByTagName('description')->item(0)->nodeValue,
        'article_ts' => $node->getElementsByTagName('description')->item(0)->nodeValue,
        'published_date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
        'inserted' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
        'updated'  => $node->getElementsByTagName('pubDate')->item(0)->nodeValue
    );
    array_push($feeds, $item);
}

/* check koneksi untu input data */
$mysqli = new mysqli('localhost', 'root', '', 'rssreader'); // ubah rssreader sesuai dengan nama database yang dibuat
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

// memasukkan data rss feed ke dalam database mysql
$stmt = $mysqli->prepare("INSERT INTO `news_article` (`title`, `url`, `content`, `summary`, `article_ts`, `published_date`, `inserted`, `updated`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param('ssssssss', $title, $url, $content, $summary, $article_ts, $published_date, $inserted, $updated);
foreach ($feeds as $feed) {
    $title = $feed["title"];
    $url = $feed["url"];
    $content = $feed["content"];
    $summary = $feed["summary"];
    $article_ts = $feed["article_ts"];
    $published_date = strftime("%Y-%m-%d", strtotime($feed['published_date']));
    $inserted = strftime("%Y-%m-%d %H:%M:%S", strtotime($feed['inserted']));
    $updated = strftime("%Y-%m-%d %H:%M:%S", strtotime($feed['updated']));
    $stmt->execute();
}
$stmt->close();
$mysqli->close();

// action untuk menampilkan data list artikel
if (isset($_POST['action']) && $_POST['action'] == "view") {
    $output =  '';
    $data = $db->read();
    if ($db->totalRowCount() > 0) {
        $output .=
            '<table class="table table-striped table-sm table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Judul Artikel</th>
                        <th>Published Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $row) {
            $output .= '<tr class="text-center">
                <td>' . $no . '</td>
                <td>' . $row['title'] . '</td>
                <td>' . $row['published_date'] . '</td>
                <td>
                    <a href="#" title="View Details Article" class="text-success infoBtn" id="' . $row['id'] . '"><i class="fa fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;
                </td></tr>
            ';
            $no++;
        }
        $output .= '</tbody></table>';
        echo $output;
    } else {
        echo '<h3 class="text-center mt-5">There is no article to show!</h3>';
    }
}

// action untuk menampilkan data detail artikel 
if (isset($_POST['info_id'])) {
    $id = $_POST['info_id'];
    $row = $db->getArticleById($id);
    echo json_encode($row);
}
