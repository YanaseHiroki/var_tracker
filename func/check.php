<!--
メインのPHPファイルか、フッターのファイルに下記の１行を挿入します。
require 'utility_check.php';
これにより、パラメーターにバリデーションをかけるためのファイルです。
-->

<?php
// 配列を受け取り、各要素のタグを代わりの文字に置き換えて配列を返す関数
function h ($arr) {
  foreach ($arr as &$str) {
    $str = htmlspecialchars($str);
  }
  return $arr;
} 

/**
 * フォームで未入力がないか確認する関数
 * ＠param  label       表示されるラベル（必須）
 * ＠param  name        変数名（$より後の部分）
 * ＠param  value       入力値
 * ＠return             エラーメッセージ
 */
function chk_empty ($label, $name, $value) {
    ${$name} = '';
    if ('' === $value) {
      ${$name} = $label . 'が未入力です';
    }
    return [$name => ${$name}];
}

/**
 * array_map()の返り値をキーが文字列の連想配列に成形する関数
 * ＠param  arr       chk_empty()の返り値（自己代入）
 * ＠return             なし
 */
function map_format (&$arr) {
  $tmp = [];
  for ($i=0; $i < count($arr); $i++) {
    $tmp += $arr[$i];
  }
  $arr = $tmp;
}

/**
 * ゼロ未満・数字入力をチェックする関数
 * ＠param  label       表示されるラベル（必須）
 * ＠param  name        変数名（$より後の部分）
 * ＠param  value       入力値
 * ＠return             エラーメッセージ
 */
function chk_num ($label, $name, $value) {
  $s=  'value'  ;echo "<pre>$$s<hr>",var_export(${$s}),'</pre>';

  // 数字入力チェック
  if (!is_numeric($value)) {
  ${$name} = $label . 'は数値で指定してください';


  // ゼロ未満チェック
  } elseif ($value <= 0) {
  ${$name} = $label . 'は1名以上を指定してください';
  }
  
  return [$name => ${$name}];
}

/**
 * 入力されたログインIDがDBに存在していないか確認する関数
 * ＠param  customer_id 入力されたログインID
 * ＠return             必須パラメータを受け取ったか
 */
function chk_id_exist ($pdo, $customer_id) {
  try {
    $sql = $pdo->prepare("SELECT * FROM customer WHERE customer_id=?");
    $sql->bindParam(1, $customer_id);
    $res = $sql->execute();
  } catch(PDOException $e) {
      echo('エラーメッセージ：'.$e->getMessage());
  }

  return $sql->rowCount();
}

/**
 * ログインされているか確認する関数
 * ＠param  login       ログイン情報
 * ＠return             エラーメッセージ
 */
function chk_login ($login) {

  // ログイン情報の項目名のリスト配列
  $login_labels = [ 'customer_id' => 'ログインID',
                    'customer_password' => 'パスワード',
                    'customer_name' => '氏名',
                    'customer_telno' => '連絡先電話番号',
                    'customer_address' => 'メールアドレス'];

    // 各項目の値がない場合、項目名を配列に追加する
    foreach ($login as $key => $value) {
      if (empty($value)) {
        $infos[] = $login_labels[$key];
      }
    }

    // すべての項目の値がない場合
    if (count($infos) === count($login_labels)) {
      $message = 'ログインをしてください';

    // 一部の値がない場合
    } elseif (!empty($infos)) {
      $message = explode('と',$infos) . 'が登録されていません';
    } else {
      $message = '';
    }
    return ['err_login'=> $message];
}
?>
