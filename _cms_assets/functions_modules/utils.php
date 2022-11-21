<?php
//////////////////////////////////////////////
//  便利関数
//////////////////////////////////////////////

const ARROWED_HTML = [
	'br' => [],
	"b"  => [],
	'a' => ['href' => [], 'target' => []]
];

/**
 * 検索用のbrタグの配列
 *
 * @var array
 */
const BR_TAGS = ["<br>", "<br />", "<BR>"];

/**
 * 検索用の改行コードのの配列
 *
 * @var array
 */
const NEWLINES = ["\r\n", "\r", "\n"];

/**
 * 検索用のエスケープされたbrタグの配列
 *
 * @var array
 */
const ESCAPED_BR_TAG = ["&lt;br&gt;", "&lt;br /&gt;", "&lt;BR /&gt;"];
define(
    'BR_TAGS_NEWLINES', (function () {
        return array_merge(BR_TAGS, NEWLINES);
    })()
);

/**
 * var_dumpを整形
 *
 * @param $data mixed 出力したいデータ
 *
 * @return void
 **/
function vd($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

/**
 * 文字の改行コードをbrタグに変換 + 特定のタグ以外を削除
 *
 * @param string $str カスタムフィールドの名前
 *
 * @return false|string
 */
function nbr($str)
{
    if (empty($str) || !is_string($str)) {
        return false;
    }
	return nl2br(wp_kses($str, ARROWED_HTML));
}

/**
 *  特定のタグ以外をエクケープ解除
 *
 * @param string $str
 *
 * @return false|string
 */
function unescaped($str)
{
    if (empty($str) || !is_string($str)) {
        return false;
    }
	return wp_kses($str, ARROWED_HTML);
}


/**
 * 文字をエスケープ+改行コードをbrタグに変換
 *
 * @param string $str
 *
 * @return string
 */
function brTxt($str)
{
	$strVal = esc_html(nl2br($str));
	return str_replace(ESCAPED_BR_TAG, "<br>", $strVal);
}

/**
 * metaタグのテキストを無害化
 *
 * @param string $str 無害化する文字列
 *
 * @return string 無害化された文字列
 */

function sanitizeMetaText($str)
{
    $strVal = wp_kses($str, ['br' => []]);
    $strVal = str_replace(BR_TAGS_NEWLINES, ' ', $strVal);
	$strVal = esc_html($strVal);
    return $strVal;
}

/**
 * 画像のIDから画像の取得
 *
 * @param int    $id   アセットID
 * @param string $size {thumbnail, medium, large, full}
 *
 * @return false|string
 */

function getImageFromId($id, $size = 'full')
{
    if ($id) {
        $url = wp_get_attachment_image_src($id, $size);
        return $url ? $url[0] : false;
    }
    return false;
}

/**
 * 記事IDから画像の取得
 *
 * @param string $field  カスタムフィールド名
 * @param int    $postId 記事ID
 * @param string $size   {thumbnail, medium, large, full}
 *
 * @return string|false
 */

function getImageFromPostId($field, $postId = false, $size = 'full')
{
    $id = get_field($field, $postId);
    return getImageFromId($id, $size);
}

/**
 * ページ送りのパラメータの正規化して ページ番号を返す
 *
 * @param string $mixed
 *
 * @return int
 */

function checkPageNumber($mixed)
{
    // ページパラメータのチェック
    $isNum = ctype_digit(strval($mixed));
    $n = intval($mixed);
    if ($isNum && $n !== 0) {
        return $n;
    }
    return 1;
}

/**
 * 現在のURLを取得
 *
 * @param string $url フルパスにしたいURL
 *
 * @return string
 */

function getCurrentUrl()
{
  $http = is_ssl() ? 'https' : 'http' . '://';
  $url = $http . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
  return $url;
}

/**
 * ページャー用のGETパラメータを作成
 *
 * @param int $page
 * @param string $category
 * @param string $period
 *
 * @return string
 */


function getPagerLink($page, $category = null, $period=null){
	return "?" . http_build_query([
	  "pg" => $page,
	  "category" => $category ? $category : null,
	  'period' => $period ? $period : null,
	]) . "#service";
  }


/**
 *ループ内でブロックエディタの特定ブロックの有無を判定
 *
 * @param string $block  ブロック名
 *
 */
function get_page_block($block) {
	global $post;
	$content = $post->post_content;
	$blocks = parse_blocks( $content );
	foreach($blocks as $key => $val) {
			$keyIndex = $blocks[$key]['blockName'];
			if($keyIndex == $block) {
				return true;
			}
	}
}

/**
 *ループ外でブロックエディタのpodcastブロックの有無を判定
 *
 * @param string $post  カスタムフィールド名
 *
 */
function get_podcast_block($post) {
	$content = $post->post_content;
	$blocks = parse_blocks( $content );
	foreach($blocks as $key => $val) {
			$keyIndex = $blocks[$key]['blockName'];
			if($keyIndex == 'acf/podcast') {
				return true;
			}
	}
}


/**
 * 文字をエスケープ+文字数を制限し、超過分を『…』に変換
 *
 * @param string $text
 * @param int $limit
 *
 */
function get_limited_text($text, $limit) {
	if(mb_strlen($text) > $limit) {
		$title = mb_substr($text,0,$limit);
		echo esc_html($title). '･･･' ;
	} else {
		echo esc_html($text);
	}
}
