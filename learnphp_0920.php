PHP入門講義
<?php
session_start();
error_reporting(0);
/****************************************************/
/* 引入檔案（設定檔、共同函數檔），及初始設定
/****************************************************/
include_once "function.php";  ///靜態內容(條件判斷只能用include，遇到錯誤，則會持續執行)
require_once "pagebar.php";   ///動態內容(程式內容會依其程式碼變動而變動，遇到錯誤，則會停止，並產生Fatal Errors)
$dbhost = "" ;
$dbname = "" ;
$dbuser = "" ;
$dbpass = "" ;
mysql_connect($dbhost, $dbuser, $dbpass) or die("MySQL Error: " . mysql_error());
mysql_select_db($dbname) or die("MySQL Error: " . mysql_error());


$link = link_mysql();
$title="{$_SESSION['login_name']}您好！歡迎使用校園佈告欄";
/****************************************************/
/* 流程控制
/****************************************************/
$op=isset($_REQUEST['op'])?$_REQUEST['op']:"";
$news_sn=isset($_REQUEST['news_sn'])?intval($_REQUEST['news_sn'


 mysql_query($sql) or die(mysql_error());
 header("location:index.php");
}
/****************************************************/
/* 產生主畫面 $main
/****************************************************/
$sql="select * from `school_news` where `enable`='1' order by `news_sn` desc";
//PageBar(資料數, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
mysql_query($sql);
$total=mysql_affected_rows();
$navbar = new PageBar($total, 5, 5);
$mybar = $navbar->makeBar();
$bar= "<p align='center'>{$mybar['left']}{$mybar['center']}{$mybar['right']}</p>";
$sql.=$mybar['sql'];
$result=mysql_query($sql) or die(mysql_error());
$main="
<table border=0 cellspacing=4>
";
while($news=mysql_fetch_assoc($result)){
 $news['title']=htmlspecialchars($news['title']);
 $news['user_name']=htmlspecialchars($news['user_name']);
 $date=substr($news['post_date'],5,5);
 if(empty($_SESSION['login_name'])){
 $tool="";
 }else{
 $tool="<a href='index.php?news_sn={$news['news_sn']}&op=del'><img src='images/del.png'
alt='刪除'></a>
 <a href='form.php?news_sn={$news['news_sn']}'><img src='images/edit.png' alt='編輯'></a>";
 }
 $main.="
 <tr>
 <td nowrap>{$date}<br>{$news['department']}</td>
 <td>[{$news['news_sn']}] <a
href='view.php?news_sn={$news['news_sn']}'>{$news['title']}</a></td>
 <td nowrap>$tool</td>
 </tr>";
}
$main.="</table>{$bar}";
/****************************************************/
/* 輸出主畫面
/****************************************************/
include_once('tbs_class.php');
$TBS =new clsTinyButStrong ;
$TBS->LoadTemplate('theme.html',False) ;
$TBS->Show() ;
?>


而根據網站效率專家 Steve Souders 指出，各種CSS選擇器的效率由高至低排序如下：

1. ID (#id)
2. Class (.class)
3. Type (即HTML標籤,如div)
4. 鄰接選擇器 (如: h2+p，僅作用於鄰接h2的p元素)
5. Child (如: li>ul)
6. Descendant (如:ul a)
7. Universal (*)
8. 屬性 (如: [type=”text”])
9. 摸擬類別/元素 (如: a:hover)


使用字元「*」，整張網頁下的所有元素都會套用設定。

CSS

* {color:red;}

HTML

<h1> 標題會套用紅色</h1>
<p> 段落會套用紅色</p>



E[att]   //套用於含att屬性的E標籤（簡易屬性選擇器）
E[att=val]   //套用於att屬性值為val的E標籤（精確屬性選擇器）
E[att~=val]   //套用於att屬性值包含val的E標籤（部份屬性選擇器）

CSS

div {color:black;}
div[title] {color:red;}
div[title=fishbecat] {color:green;}
div[title~=fishbecat] {color:blue;}

HTML

<div> 此區塊會套用黑色</div>
<div title="blog"> 此區塊會套用紅色</div>
<div title="fishbecat"> 此區塊會套用綠色</div>
<div title="fishbecat’s blog">此區塊會套用藍色</div>


E > F，利用>區隔兩個元素，表示在有父子關係的元素才會套用。與後代不同的是 E 及 F 元素之間不能再插入其它的元素，否則就不是父子關係了。

CSS

#wrapper > p{ color:red;}
#wrapper p { color:black;}

HTML

<div id="wrapper">
<p>在id=wrapper區塊裡的段落會套用紅色</p>
</div>

<div id="wrapper">
<span>
<p>中間多了span就只會套用黑色</p>
</span>
</div>


E + F，利用+區隔兩個元素，表示在與 E 同一層關係的相鄰 F 元素才會套用。

CSS

h1 { color:red;}
h1 + p { color:green;}

HTML

<h1>標題1會套用紅色</h1>
<p>跟h1相鄰的p會套用綠色</p>
<p>沒有跟h1相鄰的p會套用預設值</p>

E ~ F，利用~區隔兩個元素，表示在與 E 同一層關係的 F 元素全部都會套用。
不過這是CSS 3的選擇器。目前並沒有所有瀏覽器都支援，Dreamweaver CS4也沒支援。

CSS

h1 { color:red;}
h1 ~ p { color:green;}

HTML

<h1>標題1會套用紅色</h1>
<p>h1接下來p都會套用綠色</p>
<p>h1接下來p都會套用綠色</p>


:link   //連結平常的樣式
:visited   //連結查閱後的樣式
:hover   //滑鼠滑入的樣式
:active   //滑鼠按下的樣式
:focus   //目標為焦點的樣式
:lang(E)   //當語言為E的樣式
:first-child   //第一個元素的樣式

CSS

p:first-child { color:red;}
p:lang(zh-TW) { color:green;}

HTML

<div>
<p>第一個 p 會套用紅色</p>
<p>其它的 p 不會變色</p>
</div>

<div>
<p lang="zh-TW">語言為 zh-TW 會套用綠色</p>
<p lang="en">語言為 en 不會變色</p>
</div>


:first-line   //元素的第一行會套用
:first-letter   //元素的第一個字母會套用
:after   //在元素後加上內容（一般會配 content 屬性）
:before   //在元素前加上內容（一般會配 content 屬性）

CSS

p:first-line { color:red;}
p:first-letter { color:green;}
.price:before { content:"NT$";}
.price:after { content:"元整";}

HTML

<div>
<p>
第一行會套用紅色<br/>
第二行以後不會變色
</p>
</div>

<div>
<p>
第一個字會套用綠色<br/>
其它的字不會變色
</p>
</div>

<div>
數字前加上"NT$"，數字後加上"元整"：<span> 1000 </span>
</div>


您還可以用「,」逗點區隔，同時對多個選擇器定義樣式。
E, F, G，同時針對E、F、G元素設定樣式。

CSS

h1, h2, p {color:red;}

HTML

<h1>群組內的元素都套用紅色</h1>
<h2>群組內的元素都套用紅色</h2>
<p>群組內的元素都套用紅色</p>
<a>群組沒定義的元素不會變色</a>


body, h2, p, table, th, td, pre, strong, em {color:gray;}



(.)對所有id與important相同的元素
.important {color:red;}


.important {font-weight:bold;}
.warning {font-style:italic;}
.important.warning {background:silver;}


	$j = 1;
	while ($row = mysql_fetch_assoc($result) and $j <= $records_per_page){
		echo "<tr>
		<td height='20' align='center'>".$row["id"]."</td>
		<td>".$row["name"]."</td>
		<td>".$row["simpleName"]."</td>
		<td>".$row["engName"]."</td>
		<td>".$row["link"]."</td>
		<td><a href='admin_editbanner.php?id=".$row["id"]."' class='fancybox fancybox.iframe'><img src='images/z_edit.png' width='20' height='20' border='0' title='編輯' /></a>&nbsp;<a href='admin_delete.php?id=".$row["id"]."&data=c_banner' onclick='return confirm(\"確定刪除該資料?\");'><img src='images/z_delete2.png' width='20' height='20' border='0' title='刪除' /></a></td></tr>";
		$j++;
	}