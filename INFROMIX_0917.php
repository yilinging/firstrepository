Relational Database
  Relation Schema
    Relation name
    Attribute(field)
      attribute name
      data type
      domain
    Primary Key 
    Attribute Set
    Degree
    Foreign Key
  Relation專有名詞
    Tuple值組:資料紀錄
    Cardinality值組的數目
  Candidate Key
    Uniqueness Property
    Simple單一鍵值, Composite複合鍵值
    One relaltion at least has one candidate key
  P-Key
    Unique Identifier
    P-Key must be Candidate Key
  Domain
    Simple Domain, Composite Domain
  關聯表R
    Heading標題:R的Schema
    Boding本體:R的資料部分
  關聯的特性
    不重複的值組
    值組沒有順序
    屬性沒有順序
    屬性值都是單元值Atomic Value
  Foreign Key
    必是關聯表的候選鍵
    可以是單一鍵值也可是複合鍵值
  關聯表種類
  單元值Atomic Value


正規化Normalization, Normal Form(NF)
  低階正規化: 1NF, 2NF, 3NF, BCNF
    1NF:一個Relation R屬於1NF，所有屬性的Domain都僅含單元值
    2NF: R(A,B,C) A>B功能相依時，分割成 R1(A,B) R2(A,C) ,去除部分相依性
    3NF:所有不屬於P-Key都不功能相依, 去除間接相依性
    BCNF:決定性屬性(Determinant)都是該R的候選鍵
  高階正規化:4NF, 5NF


INFORMIX DATA TYPE
  CHAR：字母，數字，標點符號，特殊符號，不需運算的純數字
    CHAR(n)：n BYTES，僅能按照英文字排序
    NCHAR(n)：可按非英語系的資料排列
    存放範圍：1-32,767位元組
  NUMERIC:數字資料(整數，小數)
    INTEGER, SMALLINT：整數
      INTEGER：4 Bytes, 存放範圍-2^31 ~ 2^31-1
      SMALLINT:2 Bytes, -32767 ~ +32767
    FLOAT, SMALLFLOAT：小數
      FLOAT：8 Bytes, 被精確浮點數，16位元
      SMALLFLOAT：4 Bytes, 單精確浮點數(實數，REAL)，8位元
    DECIMAL：存放有小數位之數字資料，不超二三位數的小數
      DECIMAL(p)：整數位數加小數的總合為p，小數位數不固定
      DECIMAL(p,s)：整數位數加小數的總合為p，小數位數s，不宣告預設分別為16,2
  SERIAL：4 Bytes, 整數資料
    新增資料至TABLE時，DATABASE SERVER自動產生一個新整數給資料紀錄該欄位，要指定該欄位可用INSERT INTO，給定VALUE值，該值不可重複
    一但該欄位被宣告成SERIAL，該欄位自動成為TABLE中的P-KEY，一個TABLE只能有一個欄位為SERIAL型態
  DATE: 4 Bytes, Y4MD* (4位年, 2位月, 2位日)
  MONEY:$100，系統會自動加上$
    MONEY(p, s): 同DECIMAL
  DATETIME
    起始範圍 TO 終止範圍
    ontime  YEAR TO MINUTE：ontime記錄每一時間點的年月日時分
    cuttime YEAR TO MONTH:cuttime記錄每一時間點的年月
    2008-08-11 12:45:11.011 
    (YEAR-MONTH-DAY HOUR:MINUTE:SECOND.FRACTION)
  INTERVAL：某一時間點到另一時間點之間距
    起始範圍 TO 終止範圍
    分為兩群組，彼此不能跨越
      YEAR, MONTH
      DAY, HOUR, MINUTE, SECOND, FRACTION(十分之一秒)
        dayrange DAY TO HOUR
  BLOB；BINARY LARGE OBJECTS
    TEXT:LARGE CHARACTER OBJECTS (以DISK PAGES存放，大小不限制)
      大量文字資料，商用書信、程式原始碼、資料檔或是MEMO
    BYTE:
      存放程式或軟體可產生的檔案，圖片、程式目的碼、試算表或文件編輯軟體產生的文件檔


DB-Access六項功能表 ：
  Query-language：利用此功能表選項連結到DATABASE SERVER
  Connection：連結到資料庫
  Database：完成資料庫連結、連結切斷、建立、刪除或查看DATABASE
  Table：完成資料檔的建立、刪除或是修改資料檔的SCHEMA及查看資料檔的相關訊息
  Session：DATABASE SERVER及HOST COMPUTER的相關訊息
  Exit：結束DB-Access
  指定進入特定選項
  -q: Query-language
  -t: Table
  -c: Connection
  -d: Database
  ex: dbaccess stores7 -tc
  ( 連結stores7資料庫，進入Table選項中的Create選項)


Database中的選項
  Select
  Cteate
  Info：顯示目前資料庫的資訊
  Drop：刪除資料庫，也會刪除Schema及資料
  Close：關閉目前連結的資料庫
  Exit: 結束DB回到 DB-Access的功能表


Table中的選項
  Create：建立Table的架構(Schema)
  Alter：改變一個已經存在的Table的架構
  Info：可選擇顯示資料庫中的某一Table的資訊
  Drop：刪除一個存在資料庫中的Table，也會刪除Schema及資料
  Exit：結束TABLE，回到DB-Access的功能表


CREATE TABLE功能選項與功能對照表
  Add：游標移至SCHEMA Editor，新增屬性
  Modify：修改已存在的屬性結構
  Drop：刪除已存在的屬性
  Screen：資料表屬性很多時，可以按此選項顯示下一個畫面的屬性
  Table_options：顯示另一個功能表選項，管理此關聯表之儲存空間的分配
  Constraints：顯示另一功能表選項，包含P-Key、Foreign-Key及值域的設定
  Exit：結束TABLE Schema的建立，回到DB-Access的功能表


Schema Editor區域
  Column name
  Type
  Length
  Index：該欄位為索引鍵時，索引方式有 Unique 和 Duplicate
  Nulls：是否允許為Null(Yes/No)


Data Definition Language (DDL):建立資料庫及資料庫的Schema
  CREATE DATABASE library IN dataspace WITH BUFFERED LOG


  //可不寫TEMP，寫了代表建立的資料檔為暫存的資料檔
  //table_name唯一檔名不可與view_name或synonym_name同
  //IN dbspace表資料檔會建立在所指定的dbspace中
  //lock mode，鎖住資料管理的機制，預設為PAGE MODE
  CREATE [TEMP] TABLE table_name(
  column_1 type_length [column_level constraints],
  column_2 type_length,...
  [table-level constraints1, table-level constraints2,...]
  )
  [IN dbspace]
  [LOCK MODE (PAGE | ROW | TABLE)]
  [EXTENT SIZE first_kbytes]
  [NEXT SIZE next_kbytes]



  CREATE TEMP TABLE student(
  itemno    CHAR(5)   PRIMARY KEY,
  sno     SERIAL,
  sname     CHAR(10)    NOT NULL,
  Id      CHAR(10)    UNIQUE CONSTRAIN id,
  address   CHAR(60)    DEFAULT '台北縣',
  tel     CHAR(16),
  birthday  DATE,
  )

  CREATE DATABASE sales IN sadb;
  CREATE TABLE stock(
  itemno    CHAR(5)   PRIMARY KEY,
  stockno   CHAR(5),
  custno    CHAR(5) REFERENCES customer(custno),
  safeqty   DECIMAL(3,0),
  unitrice  DECIMAL(5,1),
  orderdate DATETIME YEAR TO HOUR,
  samonth   DATETIME YEAR TO MONTH,
  amt     MONEY
  CHECK (unitprice BETWEEN 0 AND 9999)
  PRIMARY KEY(stockno,itemno),
  FOREIGN KEY (custno) REFERENCES order ON DELETE CASCADE)
  //Table order和orderitem為Master-Detail
  //加上ON DDELETE CASCADE,當Master Table order被刪除時，相關的orderitem記錄也會一併刪除 
  LOCK MODE(ROW)
  IN inventorydb
  EXTENT SIZE 20



  CREATE INDEX:針對已存在的資料檔

  //UNIQUE、DISTINCE，檢查資料不重複
  //CLUSTER:依照後面所指定的column重整及排列
  //DESC：資料升冪排列
  //FILLFACTOR #%：#表數字，所具備的單位是%
  /[DISABLED | ENABLED | FILTERING[WITHOUT ERROR | WITH ERROR]]：控制資料INSERT、UPDATE、DELETE操作時該索引黨的相對動作，預設為ENABLED
  CREATE[UNIQUE | DISTINCT] [CLUSTER]
    INDEX index_name
    ON table_name (column_1 [DESC], column_2, ...)
    [FILLFACTOR #%] [IN dbspace]
    [DISABLED | ENABLED | FILTERING
    [WITHOUT ERROR | WITH ERROR]]

  CREATE UNIQUE INDEX itemidx ON item (itemno)
  CREATE INDEX stockidx ON stock (itemno)
  CREATE CLUSTER INDEX clu_itemidx
    ON item(itemno)
  CREATE INDEX historyidx ON history
    (itemno, samonth, amt DESC)
  CREATE INDEX orderidx ON order
    (custno, orderno) FILLFACTOR 60
  CREATE TABLE order
    . 
    .
  CREATE INDEX idx_order ON order(custno)
    IN saind


    //ADD增加, DROP刪除, MODIFY修改
  ALERT TABLE table_name
    ADD 子句 | DROP 子句 | MODIFY子句
    | ADD CONSTRAINT 子句 | DROP CONSTRAINT 子句
    | MODIFY NEXT SIZE 子句 | LOCK MODE 子句

    ALTER TABLE item ADD(
      unit CHAR(4) DEFAULT 'PC' NOT NULL,
      weight DECIMAL(5,2)
      classno CHAR(4) REFERENCES class(classno))

    ALERT TABLE student DROP CONSTRAINT id

    ALERT TABLE history ADD CONSTRAINT
      (FOREIGN KEY(itemno) REFERENCES item
      ON DELETE CASCADE CONSTRAINT item)

    ALERT TABLE orderitem ADD CONSTRAINT
      CHECK (unitprice BETWEEN 1 AND 1000)

    ALERT TABLE orderitem
      MODIFY(qty DECIMAL(5,0) DEFAULT '1'
      NOT NULL)

    ALERT TABLE history 
      ADD CONSTRAINT UNIQUE
      (custno, itemno, samonth)
      CONSTRAINT area

    ALERT TABLE sutdent MODIFY NEXT SIZE 20




  ALERT INDEX：改變已經存在的索引檔，些換為CLUSER或非CLUSTER
    ALERT INDEX index_name TO [NOT] CLUSER
    ALTER INDEX clu_itemidx TO NOT CLUSTER
    ALERT INDEX idx_order TO CLUSER

  DROP DATABASE：刪除已存在的DATABASE
    DROP DATABASE database_name
    DROP DATABASE sales

  DROP TABLE：刪除已存在的TABLE
    DROP TABLE table_name[CASCADE | RESTRICT]
    DROP TABLE library:student  //library為資料庫
    DROP TABLE history CASCADE


  DROP INDEX：刪除已存在的INDEX
    DROP INDEX index_name


Data Manipulation Language (DML):新增、刪除、修改紀錄或擷取資料或資訊
  INSERT 子句
    INSERT INTO table_name|view_name
      [(column_1, column_2, cloumn_3,...)]
    VALUES(值_1, 值_2, 值_3, ...) |SELECT 子句
    //table_name|view_name，對table或view增加記錄
    //值可為TODAY, CURRENT, SITENAME, DBSERVERNAME 或是 NULL
    //不可用FIRST, INTO TEMP, ORDERBY 和 UNION

    CREATE VIEW base_salary_view AS
      SELECT lname, fname, base_salary
      FROM base_salary
      WHERE entered_by=USER
    INSERT INTO base_salary
      VALUES('CHEN', 'CINDY', 2500, USER)

    INSERT INTO orders(orders_num, order_date, Customer_num)
      VALUES(0, NULL, 001)
    //VALUES為0，因為orers_num欄位型態是SERIAL

    LOAD FROM 'new_custs' INSERT INTO lily.customer
    //由文字檔new_custs載入，一次多筆新增到customer資料檔，customer之前的資料擁有者為lily

    LOAD FROM 'D:\data\new_orders' DELIMITER ';'
      INSERT INTO orders
    //每筆資料的識別符號(及DELIMITER該系統變數)為;(INFORMIX預設符號為\)

  UPDATE 子句
    UPDATE table_name | view_name
      SET 子句
      [WHERE CURRENT OF cursor_id]
      [WHERE 條件句]
      //SET子句可以是 SET*=(常數值|變數值|SELECT 子句|NULL, ...)

    UPDATE orders
      SET ship_charge=
        (SELECT SUM(total_price) * .09
        FROM items
        WHERE orders.order_num=items.order_num)
      WHERE orders.order_num=1003

    UPDATE customer
      SET(address1, address2, city, zipcode)
       =('No. 1101 Green St.', NULL, 'Athens', '45701')
       WHERE customer_num=101

    UPDATE manufact
      SET * =('ARZ', 'Arizer')
      WHERE manu_code='ANZ'

    UPDATE items
      SET(stock_num,manu_code,quantity)
       =((SELECT stock_num, manu_code FROM stock WHERE description='baseball'),2)
       WHERE itme_num=1 AND order_num=1001
       //WHERE customer_num IN (SELECT cust_num FROM new_address)

  DELETE 子句
    DELETE FROM table_name | view_name
      [WHERE 條件句]
    //刪除資料記錄，不刪除TABLE

    DELETE FROM items
      WHERE order_num<1010

  SELECT 子句
    SELECT[FIRST#][DISTINCT|UNIQUE]
    //DISNICT, UNIQUE：如有多筆資料或重複的相同值被選取，只會選取相同記錄中的一筆記錄
    //#為數字
      [table.|view.|alias.]*
      [table.|view.|alias.]column_1,. , ...
      [table.|view.|alias.]column_1[[AS] display_label],.,
      [table.|view.|alias.]運算式[[AS] display_label],. ,.
      [table.|view.|alias.]column_1 INTO pg_variable,.,...
      FROM table_name|view_name[AS][alias]
      [OUTER][, additional tables]
      [WHERE 子句]
      [GROUP BY 子句]
      [HAVING 子句]
      [ORDER BY 子句]
      [FOR READ ONLY|FOR UPDATE[OF column_1,..]]
      [INTO table子句]
      [[UNION|UNION ALL]另一個SELECT子句]
      //按照上列順序出現

    GROUP BY
      GROUP BY[table.|view.|alias.]column_1|#,., ...
      //群組，因為SELCET後面用aggreate function

    HAVING
      HAVING會與GROUP BY子句合用

    ORDER BY
      ORDER BY[table.|view.|alias.]column_1| # |display_label |column_1[#1,#2][ASC|DESC],.,...
      //ASC升幂 DESC降冪 
      //只能出現在最後一個SELECT子句中

    FOR READ ONLY|FOR UPDATE[OF column_1,..]
      FOR READ ONLY:僅可讀取而不能修改
      FOR UPDATE:可供修改
      OF column_1,.. :欄位用逗號隔開

    INTO table
      所選取資料存到另一TABLE
      INTO TEMP table_name[WITH NO LOG]| SCRATCH table_name| EXTERNAL table_name USING子句
      //WITH NO LOG:暫存檔
      //寫在最後一個SELECT子句中

    [[UNION|UNION ALL]另一個SELECT子句]
      將兩個或多個SELECT子句的結果結合成為一個查詢的結果

  WHERE 條件式
    不能單獨執行，需至於INSERT, UPDATE, DELETE, SELECT句子 中才能執行

    WHERE [NOT]
      Comparison_Condition |
      Condition_with_Subquery
      [AND | OR]
      [更多的比較條件式]
      //NOT：相反, TRUE->FALSE
      //BETWEEN ... AND ...
      //IN(...) :常數串、系統環境變數或是變數串
      //IS NULL
      //LIKE '...'
        %: 沒有或更多字元
        _: 任一個字元
        \: 如要同時搜尋% _ 則用\代替
      //MATCHES '...'
        與 * ? [...] ^ \ 一起使用
          *: 沒有或更多字元
          ?: 任一個字元
          []: 表示搜尋的資料可以是[]一串字元中的任一個
          ^: 放在[]中搭配使用，放在第一個，表示不可以是[]中的任一個
          \: 如要同時搜尋* ? 則用\代替

      再成立一個SELECT語法稱Subquery
        [NOT] IN | EXISTS | (ALL |ANY |SOME) Subquery


Aggreate Function
  COUNT(*) |
  AVG| MAX| MIN| SUM <[ DISTINCT | UNIQUE] [ table. | view. ] column_1 >
  | COUNT<[ DISTINCT | UNIQUE] [ table. | view. ] column_1 >
  | AVG| MAX| MIN| SUM |RANGE <[ALL]運算式>

  COUNT(*)
    符合條件的資料記錄筆數
    SELECT fname, COUNT(*) FROM customer
      GROUP BY fname
      HAVING COUNT(*)>1
    //得到的COUNT(*)是每個fname的資料記錄比數

  AVG| MAX| MIN| SUM([ DISTINCT |UNIQUE ] [table. |view.] column_1)
    平均值 | 最大值 | 最小值 | 加總
    SELECT SUM(total_price)FROM items
      WHERE order_num=1006

  COUNT<[ DISTINCT | UNIQUE] [ table. | view. ] column_1 >
    [ DISTINCT | UNIQUE]:取得不同的該欄位資料記錄的筆數
    不加[ DISTINCT | UNIQUE]，則取得欄位資料記錄中非NULL的筆數
    SELECT COUNT(DISTINCT item_num) FROM items
    SELCET COUNT(ALL item_num) FROM items

  RANGE <[ALL] 運算式>
    主要取的RANGE()中的()中所指定的欄位資料記錄的最大值與最小值之差
    RANGE(欄位變數)=MAX(欄位變數)-MIN(欄位變數)
    SELECT RANGE(unit_price) FROM stock
      WHERE stocknum = 1


4GL Program的組成分子
  Modle, Form, Program(Module, Form), Query-language, EXIT

  {module calculate.4gl}
  MAIN
    CALL prog_init()
    #program_init() is to initialize program variable
    CALL calculate()
  END MAIN
  //大小寫不影響程式的執行
  //註解 {} # -


Program的邏輯
  判斷式的語法(IF, CASE)
    IF
      IF 判斷式 THEN
        4GL 指令
      ELSE
        4GL指令
      END IF

      IF state = "OH" THEN
        IF zipcode MATCHES '451*' THEN
          ERROR "City is Athens."
        END IF
      END IF 
    
    CASE
      CASE[Program_variable]
        WHEN condition1(4GL 運算式 | Boolean 運算式)
          4GL 指令
          [EXIT CASE]
        WHEN condition2(4GL 運算式 | Boolean 運算式)
          4GL 指令
          [EXIT CASE]
        更多的WHEN conditiona...
        [Otherwise]
          4GL 指令
          [EXIT CASE]
      END CASE


      WHEN yes_no MATCHES "[Yy]"
        CALL process()
      WHEN yes_no MATCHES "[Nn]"
        CALL abort()
      OTHERWISE
        CALL retry()
      END CASE


      CASE(print_option)
        WHEN "f"
          PROMPT"輸入要存入的檔案名稱: "
            FOR file_name"
          IF file_name IS NULL THEN
            LET file_name = "temp.out"
          END IF
          MESSAGE "將此份報表存入",
            File_name CLIPPED,"...請稍後."
          START REPORT sales_report TO file_name
        WHEN "p"
          MESSAGE "開始列印報表，請稍後"
          START REPORT sales_report TO PRINTER
        WHEN "s"
        --輸出到螢幕
          START REPORT sales_report
          CLEAR SCREEN
      END CASE

  迴圈式語法(FOR, WHILE)
    FOR
      FOR counter = 起始值 TO 終止值 [STEP 增加值]
        4GL 指令
        [CONTINUE FOR]
        [EXIT FOR]
      END FOR

      FOR i=1 TO 6
        DISPLAY month_amt[i] TO s_month_amt[month]
        LET month = month + 1
      END FOR
      //STEP增加值若不指定，預設為1，也可以為負的數字
      //與FOR語法類似，但行為與CURSOR有關的指令FOREACH



    WHILE
      WHILE Boolean_運算式
        4GL指令
        [EXIT WHILE]
        [CONTINUE WHILE]
      END WHILE

      WHILE yes_no ='y'
        CALL process()
        PROMPT "你還要繼續此項作業嗎?(Y/N)"
          FOR yes_no
      END WHILE

      WHILE true
        4GL 指令
        IF status = 0 THEN EXIT WHILE
        END IF 
        4GL 指令
      END WHILE

  
  其他會改變程式執行順序的語法
    GOTO label: 將執行順序導至標示label處
    CALL function_name(): 將執行順序導至FUNCTION，但執行到RETURN指令會回到CALL的下一行繼續執行


Screen綜合指令
  MENU：產生一功能選項，供使用者操作
  CLEAR：清除畫面
  ERROR：顯示訊息於ERROR LINE[4GL 中有指定特定列] 且嗶一聲以示警
  MESSAGE：顯示訊息於MESSAGE LINE
  PROMPT：顯示訊息於PROMPT LINE並接收使用者的回應
  OPTIONS：改變上述[三到五項]指令的特定顯示列的列數，可設定HELP按鍵
  OPEN WINDOW：在SCREEN上開啟視窗
  CURRENT WINDOW：切換目前視窗，此時INPUT 或 OUTPUT 均是針對此視窗
  CLOSE WINDOW：關閉視窗
  OPEN FORM：開啟一個已編譯完成的FORM在4GL程式中
  DISPLAY FORM：顯示一個已開啟的FORM於螢幕上
  CLOSE FORM：關閉FORM，實質上是將該FORM自主記憶體中除去
  CONSTRUCT：提供使用者輸入資料，通常使用在QBE的查詢功能中
  DISPLAY：顯示訊息或變數值於程式中特定的位置或目前游標所在的下一列
  DISPLAY ARRAY：將Program Array給 Screen Array 並顯示在螢幕上，如果資料很多的話，允許捲動螢幕
  INPUT：提供使用者輸入資料
  INPUT ARRAY：提供使用者輸入Array的資料於螢幕上
  SCROLL：主要作用在Array上，使得畫面上捲或下捲


Report的產生
  START REPORT：啟動報表產生功能
  OUTPUT TO REPORT：傳遞一筆記錄給報表輸出函數
  FINISH REPORT：關閉報表產生功能


Run Time Error的處理
  WHENEVER ERROR
  配合Status、Sqlca.sqlcode等系統變數的使用


MENU 的組成分子
  Main Menu: Customer Orders Stock Reports Exit

  main  
    call main_menu()
  end main
  function main_menu()
    menu "Main Menu: "
      command "Customer" "進入客戶資料維護功能表"
        call dummy()
      command "Orders" "進入訂單資料維護功能表"
        call dummy()
      command "Stock" "進入庫存資料維護功能表"
        call dummy()
      command "Reports" "進入報表功能"
        call dummy()
      command "Exit" "結束"
        exit menu
    end menu
  end function
  function dummy()
    error "功能尚未完成"
  end function


  MENU之語法
  MENU "功能表名稱"
    [BEFORE MENU]
      [4GL commands]
      [NEXT OPTION "選項"]
      [HIDE | SHOW OPEION "選項",.. | ALL] 
      // HIDE OPTION ALL 先隱藏所有option, 再顯示特定option
      [CONTINUE MENU | EXIT MENU]
    COMMAND "選項" "輔助說明訊息" | COMMAND KEY(按鍵) 
    | COMMAND KEY(按鍵) "選項" "輔助說明訊息" 
    //(CONTROL-A) 按下時即會執行COMMAND間的指令
      [HELP 輔助說明之編號]
      [4GL commands]
      [CONTINUE MENU] //以下不執行，從MENU開始執行
      [EXIT MENU] //結束MENU
      [NEXT OPTION "選項"]
  END MENU


螢幕交談指令
  CLEAR SCREEN：清除螢幕上所有事物，包含PROMPT, ERROR...
  ERROR：顯示訊息，且嗶一聲
    ERROR "string",... | variable, ...[ATTRIBUTE 子句]
    //後面可以接一個或數個字串，用逗號隔開
    //ERROR "編號", p_customer,customer_num USING "###", "錯誤"
  MESSAGE：顯示訊息
    MESSAGE "string",... | variable, ...[ ATTRIBUTE 子句]
  DISPLAY：可以單純顯示訊息，也可以與程式中的變數合作，顯示資料或資訊;與ERROR和MESSAGE不同為DISPLAY可以指定顯示時的位置
    DISPLAY("string|variable|TEXT,... TO field_1,...")|(BY NAME variable,...)[ATTRIBUTE 子句]
  PROMPT：顯示訊息，亦可提供給使用者輸入，亦可在整個結構中撰寫程式
    PROMPT "string"|variable,...[ATTRIBUTE 子句]
      FOR[CHAR] variable
      [HELP輔助說明之編號]
      [ON KEY(按鍵) 
        SQL|4GL statement
    END PROMPT]
  DISPLAY FORM
  CURRENT WINDOW
  OPEN WINDOW
  INPUT
  INPUT ARRAY
  DISPLAY ARRAY 
  CONSTRUCT
  MENU

  ATTRIBUTE子句：不能單獨存在，須與其他的交談指令一起使用
    ATTRIBUTE(
      [REVERSE|BLINK|UNDERLINE]
      [BLACK|BLUE|CYAN|GREEN|MAGENTA|RED|WHILE|YELLOW] //以上第二項不可混和選取
      [BLOD|DIM|INVISIBLE|NORMAL]
      ,...)
      //以上三個可同時存在，用逗號隔開
  按鍵
    可用按鍵與寫法
    ACCEPT 
    ESC or ESCAPE
    INTERRUPT
    HELP
    TAB
    RETURN or ENTER
    DOWN
    UP
    LEFT
    RIGHT
    NEXT or NEXTPAGE
    PREVIOUS or PREVPAGE
    INSERT
    DELETE
    F1 through F64
    CONTROL-char(但A, D, H, I, J, K, L, M, R, X 不能使用)


OPTIONS之語法
  OPTIONS[
  COMMENT   LINE FIRST +#|#|LAST+#
  ERROR     LINE FIRST +#|#|LAST+#
  FORM    LINE FIRST +#|#|LAST+#
  MENU    LINE FIRST +#|#|LAST+#
  MESSAGE   LINE FIRST +#|#|LAST+#
  PROMPT    LINE FIRST +#|#|LAST+#
  ACCEPT    KEY 按鍵
  DELETE    KEY 按鍵
  INSERT    KEY 按鍵
  NEXT    KEY 按鍵
  PREVIOUS  KEY 按鍵
  HELP    KEY 按鍵
  HELP FILE "filename"
  DISPLAY   ATTRIBUTE 子句
  INPUT     ATTRIBUTE 子句
  FIELD ORDER UNCONSTRAINED | CONSTRAINED
  SQL_INTERRUPT ON|OFF
  PIPE    IN FORM MODE | IN LINE MODE
  RUN     IN FORM MODE | IN LINE MODE]


HELP的產生
  Step1.新增text file
    orderhelp.msg
      . 1
      新增客戶資料
      . 2
      新增客戶訂單資料
      . 100
      提供全系統之報表列印功能
      . 500
      選擇Y, 自動更新資料
    //". 號碼"號碼順序皆可，但同一文檔中，號碼不可重複

  Step2. 執行mkmessage utility去產生步驟一的文字檔的object code
    mkmessage filename1 filename2
      filename1為步驟一產生的檔案名稱
      filename2為經由utility後所產生的oject code的檔案名稱
      filename1和filename2可一樣，但filename2副檔名建議為(.ex)
    mkmessage orderhelp.msg orderhelp.ex
  Step3. OPTIONS中指定HELP FILE
    FUNCTION set_options()
      OPTIONS
        MESSAGE LINE LAST-2,
        PROMPT LINE FIRST+2,
        HELP FILE "orderhelp.ex",
        HELP KEY CONTROL-Q
    END FUNCTION
    //系統預設HELP KEY為(CONTROL-W)
  Step4.提供(輔助訊息說明)的程式部分，加上呼應號碼
    FUNCTION user_sure()
      PROMPT "Are you sure(Y/N)?"
      FOR CHAR answervar
      HELP 500
    END FUNCTION

    ...
    MENU "訂單管理系統"
      COMMAND "C客戶資料" "客戶資料管理功能表"
        HELP 1
        CALL dummy()
      COMMAND "R報表資料" "報表資料管理功能表"
        HELP 100
        CALL dummy()
    ...


FORM 的組成：DATABASE, SCREEN, TABLES, ATTRIBUTES 和 INSTRUCTIONS
  是哪個DATABASE
  是屬於這個DATABASE中的那些TABLE
  是TABLE中的那些欄位
  將資訊填入FROM的每個SECTION中
  FORM由五個SECTION組成
  且SESSION間的順序不可顛倒

  DATABASE Section
    DATABASE database_name | FORMONLY
    //如果此SCREEN FORM不與任何的DATABASE有關，則可註明FORMONLY
    DATABASE stores7
    DATABASE FORMONLY

  SCREEN Section
    設計該FORM被執行時，顯現出來的長相
    SCREN [SIZE #1 [BY #2]]
    {
      螢幕畫面在此設定
    }
    END
    //[SIZE #1 [BY #2]]：SCREEN的大小，#1為列數，#2為寬多少字元
    //SIZE #1 預設24列, BY #2 預設為該SCREEN每一列的最大字元數
    SCREEN
    {
    ============ CUSTOMER FORM ============
    Number:[f000    ]-[f001    ]
    ---------------------------------------------------------
    Sate...... : [a](Y/N)
    Telephpone...... : [b](Y/N)
    =========================================================
    }
    //[]:欄位輸出入的邊界，之間的空格即為該欄位在此FORM提供的大小
    //f000為欄位標籤(Field Tag)：第一個字元須為英文或是_
    //a：是因為該欄位大小只有1 Byte
    //資料型態所對應的長度
      DECIMAL：TABLE中定之總長度+2
      MONEY：TABLE中定之總長度+3
      CHARACTER：TABLE中定之總長度
      SMALLINT：6
      INTEGER：11
      SERIAL：11
      SMALL FLOAT：14
      FLOAT：14
      DATE：10
      DATETIME：TABLE中定之總長度
      INTERVAL：TABLE中定之總長度+1

  TABLES Section
    此SCREEN FORM所用到的TABLE須在此Section中列出
    TABLES [alias = ] table_name ...[END]
    //是用到的TABLE名稱均須在此列出，彼此間不需要任何符號隔開
    //[alias=]幫TABLE設定別名，下個 ATTRIBUTE Section就可使用此別名
    //如果DATABASE Section部分定為 FORMONLY，則此Section省略
    TABLES customer orders
    TABLES cust = customer ord = orders END

  ATTRIBUTES Section
    訂定每個螢幕欄位的特性，該欄位的型態、長度和一些特殊效果...
    ATTRIBUTES
      Field Tag = 欄位描述; ...
    END
    欄位描述部分：
    若Field Tag 是參照 DATABASE 中的欄位，則採下列寫法
      table_name。column_name [,attribute, ...]
    若Field Tag是為FORMONLY的欄位，則採下列寫法
      FORMONLY.field_name
        [TYPE data type[NOT NULL]| TYPE LIKE table_name.column_name]
        [,attrubute, ...]
    //[attribute 子句]
    AUTONEXT：適用於資料填滿特性，自動跳到下一欄位
    
    COLOR = ATTRIBUTE [WHERE 子句] :該欄位顏色或粗體
      COLOR=YELLOW
    
    COMMENTS = "strings" :所需提供或注意的訊息顯示在螢幕上
      COMMENTS='不可空白!';
    DEFAULT = value ：此value不可是自訂變數或任何定義的function，但可以是系統的變數或常數
    
    DISPLAY LIKE table_name.column_name： 將該Field Tag的屬性設定參照一個table中的某欄位
    
    DOWNSHIFT：所有英文字母均轉成小寫
    
    FORMAT = "format-string" ：主要是作用在DECIMAL, SMALLFLOAT, FLOAT 或DATE型態，控制輸出時的顯示格式，""內可用# 。 ，
    
    INCLUDE = (value[TO value], ... |NULL)：定義此資料欄位的值域
    
    INVISIBLE：USER輸入資料時不顯示在螢幕上
    
    NOENTRY：當程式中使用INPUT或INPUT NONETRY時，該欄位被設定 NOENTRY屬性 ，，則USER無法在此欄位輸入資料
    
    PICTURE = "format-string"：資料輸入時的格式設定，可用的符號為A # X(A:接收任何字母, #:接收任何數字, X:接收任何字元)
    
    PROGRAM = "command"：當USER輸入到此資料欄位時，可執行外部的應用程式並使用，常發生在資料欄位型態為TEXT或BYTE
    
    REQUIRED：強迫使用者藉由INPUT或INPUT ARRAY指令輸入到此資料欄位時，一訂要輸入資料
    
    REVERSE：將資料欄位反白
    
    UPSHIFT：將使用者輸入的英文字母全部轉大寫

    VALIDATE LIKE[table_name.] column_name：使用者輸入資料後的檢查依照LIKE後所指定的table_name中的column_name

    VERIFY:於輸入資料時，要求使用者輸入資料兩次，並比較輸入是否一致

    WORDWRAP[COMPRESS|NONCOMPRESS]：當資料欄位型態CHAR長度超過58 bytes，稱為Long CHAR Field，於INFORMIX的SCREEN FORM中遇到此狀況時，會自動將其切割成兩等份或三等份顯示於螢幕上
      使用時，有些特殊意義的按鍵
        CONTROL-A：做為insert mode與over mode間的切換
        CONTROL-X：刪除游標目前所在的字元
        CONTROL-D：刪除游標目前所在的字元到此資料欄位的終了
        CONTROL-N：新增一個新的列
  
  INSTRUCTIONS Section
    該Section是選擇性的，但一旦要使用就必須加在ATTRIBUTES Section後，此Section有三個主要目的
      定義 SCREEN RECORDS
      定義 SCREEN ARRAYS
      改變 SCREEN Section 中的field tag的邊界符號

    INSTRUCTIONS
      [DELIMITERS "起始邊界符號 結束邊界符號"]
      [SCREEN RECORD record_name (Field List)]
      [SCREEN RECORD array_name[#] (Field List)]
    [END]
    --以下為(Field List)部分，詳細介紹之
    [table_name.] *| 
    1st_column_name, 2nd_column_name,...|
    1st_column_name(THROUGH | THRU)[table_name.]last_column_name

    SCREE RECORD worlds_record
      (items.*, customer.*, state.cod, FORMONLY.total)
  

WINDOW & FORM
  OPEN WINDOW
    此指令會開啟WINDOW，WINDOW大小自由設定
    OPEN WINDOW window_name AT 第一列#，最左#
      WITH #1 ROWS, #2 COLUMNS
      [ATTRIBUTE 子句] //顏色、特效、PROMPT LINE

    OPEN WINDOW w2 AT 10,10 WITH 10 ROWS, 40 COLUMNS
      ATTRIBUTE (MESSAGE LINE9, PROMPT LINE LAST-2, FORM LINE FIRST)

  OPEN WINDOW (4GL決定WINDOW的大小)
    OPEN WINDOW window_name AT 第一列#，最左#
      WITH FORM "filename"
      [ATTRIBUTE 子句]

  CURRENT WINDOW
    CURRENT WINDOW is window_name | SCREEN

    OPWN WINDOW w1 AT 3,3 WITH 15 ROWS,70 COLUMNS
      ATTRIBUTE(BORDER)
    OPWN WINDOW w2 AT 3,10 WITH 10 ROWS,65 COLUMNS
      ATTRIBUTE(BORDER)
    CURRNET WINDOW IS w2

  CLOSE WINDOW
    CLOSE WINDOW window_name

  CLEAR
    CLEAR SCREEN | FORM | WINDOW window_name | WINDOW SCREEN |field_list


變數的DEFINE與運算
  DEFINE變數
    DEFINE variable_1 [, variable_2,...] DATA TYPE | LIKE field_list

    DEFINE x,y,z INT
    DEFINE mat MONEY(7,0)

  DEFINE variable_1 [, variable_2,...] DATA TYPE
    直接型定義方式的語法
    DEFINE variable_name Simple_data_type | Large_data_type
    結構化資料型態的語法
    DEFINE variable_name RECORD
      Member_1 Data_type | LIKE...,
      Member_2 Data_type | LIKE...,
      ...
    END RECORD


  DEFINE variable_1 [, variable_2,...] LIKE field_list
    DEFINE variable_1 LIKE field_list間接型定義方式的語法
    DEFINE variable_name LIKE Field_list
    以下為結構化資料型態的語法中的第一種
    DEFINE variable_name RECORD
      Member_1 LIKE Field_list
      Member_2 LIKE Field_list
      ...
    END RECORD
    以下為結構化資料型態的語法中的第二種
    DEFINE variable_name RECORD LIKE table_name.*

  變數的運算
    用LET或INITIALIZE兩個指令訂定變數的值
      LET variable_name=...
      INITIALIZE variable_name TO NULL：變數值設定為空
      INITIALIZE variable_name LIKE table_name.field_name
      //該變數值是參考某特定table_name的某field_name的預設值

      LET total_price=NULL

      LET sqlstr="SELECT * FROM customer" ||
        "WHERE lname MATCHES\""
        || last_name CLIPPED, "\""

      LET x.*=y.*

      INITIALIZE p_orders.8 TO NULL

      INITIALIZE var1, var2 LIKE tab1.col1, tab1.col2

      INITIALIZE p_customer.* LIKE customer.*

    數值運算
      ** 指數運算 (9**3 = 9^3 =729)
      MOD 餘數

    字串運算
      [#1, #2]：取得部分字串，由第#1位元開始到第#2位元結束
      CLIPPED：將字串後多餘的空白去掉
      USING：格式化字串
      WORDWRAP：對LONG CHAR顯示必須多列顯示時的處理
      LIKE：兩個字串間的比較( % 取代一串字元， _ 取代一個字元)
      MATCH：兩個字串間的比較( %*取代一串字元， ? 取代一個字元)

    Boolean運算：TRUE/FALSE
      AND：均為TRUE，才為TRUE
      OR：只有一個為TRUE就為TRUE
      NOT：TRUE FALSE互換
      IS [NOT] NULL：是否為空值
      [NOT] IN ()：是否在() 中所訂定的值域
      [NOT] BETWEEN ...AND：是否在BETWEEN...AND...之間


INPUT指令
  INPUT variable_1 [, variable_2, ...] | variable_start THRU vairable_end
    [WITHOUT DEFAULTS] //加上此部分時，4GL變數的值不會被清除掉
    FROM SCREEN_field_name | SCREEN_record_name.*
  
  INPUT BY NAME variable_start THRU variable_end [WITHOUT DEFAULTS]
    [ATTRIBUTE 子句]
    [HELP 輔助說明之編號]
    [input control block..
    END INPUT]

    [input control block... 如下
      BEFORE {(FIELD Field List) | INPUT}
      AFTER {(FIELD Field List) | INPUT}
      ON KEY (按鍵，...)
      {4GL | SQL statement | NEXT FIELD {(Field List) | NEXT | PREVIOUS} | {EXIT | CONTINUE} INPUT }
      //BEFORE FIELD：觸發時機(trigger time)在輸入點移動到該Field_list時，但在使用者被允許開始輸入資料前，顯示訊息給使用者，或初始值得設定與顯示
      //AFTER FIELD：當輸入點離開Field_list此螢幕欄位後，做必要性的檢查，每個欄位至多被指定一次AFTER FIELD

    INPUT p_items.* FROM s_items.*
      ON KEY (CONTROL-B)
        IF INFIELD(stock_num) OR INFIELD (manu_code)
          THEN CALL stock_help()
            NEXT FIELD quantity
        END IF
    //INFIELD() 是INFORMIX-4GL的內建函數，判斷目前輸入點所在的螢幕欄位與()中指定的欄位是否一樣

  內建函數
    FIELD_TOUCHED()：使用者是否更改過()中指定的欄位值，改過回傳TRUE
    GET_FLDBUF()：傳回一個或多個欄位的內容字串值
    FGL_GETKEY()：等待使用者按一按鍵，且將按鍵相對的一個整數值傳回
    FGL_LASTKEY()：將使用者最近按的一按鍵相對應的整數傳回來
    INFIELD()：判斷目前的欄位名稱是否為()所指定的欄位名稱，若是傳TRUE


記錄的新增
  Step1 定義所需要的變數
  Step2 要求使用者入該table的主鍵值 (P-KEY)
  Step3 以P-KEY檢查是否已經存在TABLE中，不存在才可往下
  Step4 提供使用者輸入非P-KEY的其他欄位的資料
  Step5 輸入同時，針對資料欄位的值域做資料有效性檢查
  Step6 等待使用者的確認無誤
  Step7 將螢幕資料寫入到資料庫的TABLE中

  //以下範例只完成step1,2,3,4,7
  {Module3 cust_inp.4gl}
  GLOBALS "cust_globs.4gl"

  FUNCTION input_cust()
    INPUT BY NAME gr_customer.* //提供使用者輸入資料，因為customer_num是customer table的P-KEY，且資料型態為SERIAL，故INPUT指令不會提供該欄位的輸入
    LET gr_customer.customer_num = 0  //因為customer_num資料型態，因此給0，當執行INSERT時，資料庫會自動提供號碼給該欄位
    INSERT INTO customer VALUES (gr_customer.*) //此SERIAL的資料欄位要在INSERT INTO執行完成後加上下列程式碼
    //LET gr_custmoer.customer_num = SQLCA.SQLERRD
    //DISPLAY BY NAME gr_customer.customer.num
    //MESSAGE "Customer No.", gr_customer.customer_num
    //USING "<<<<", "is added."
  END FUNCTION
  //利用GLOBALS指令參照cust_globs.4gl此MODULE，該程式主要在定義總體變數，以供一個PROGRAM中多個MODULE使用


記錄的修改
  Step1 定義所需要的變數
  Step2 要求使用者入該table的主鍵值 (P-KEY)
  Step3 以step2的P-KEY檢查TABLE，必須存在才可進行step4
  Step4 將TABLE中的資料設定到4GL程式中的變數
  Step5 提供使用者修改非P-KEY的其他欄位的資料
  Step6 輸入同時，針對資料欄位的值域做資料有效性檢查
  Step7 等待使用者的確認無誤
  Step8 將螢幕資料寫入到資料庫的TABLE中


記錄的刪除
  Step1 定義所需要的變數
  Step2 要求使用者入該table的主鍵值 (P-KEY)
  Step3 以step2的P-KEY檢查TABLE，必須存在才可進行step4
  Step4 將TABLE中的資料設定到4GL程式中的變數
  Step5 將此筆資料完整的顯示出來，以讓使用者確定是否該筆資料要刪除
  Step6 等待使用者的確認無誤
  Step7 將該資料從TABLE中刪除掉


完整範例
  此MODULE為此PROGRAM的GLOBALS設定
    {MODULE_1, stores_globs.4gl}

    DATABASE stores7

    GLOBALS
      DEFINE gr_stock RECORD LIKE stock.*
      DEFINE nr_stock RECORD LIKE stock.*
    END GLOBALS

  以下MODULE為主功能表
    {MODULE main.4gl}
    GLOBALS "stores_globs.4gl"

    MAIN
      CALL prog_init()
      CALL main_menu()
    END MAIN

    FUNCTION prog_init()
      OPTIONS
        INPUT WRAP //使用者必須按 ACCEP KEY或INTERRUPT KEY才能結束INPUT指令
    END FUNCTION

    FUNCTION main_menu()
      MENU "Main Menu:"
        COMMAND "Customer" "進入客戶資料維護功能表"
          CALL dummy()
        COMMAND "Orders" "進入訂單資料維護功能表"
          CALL dummy()
        COMMAND "Stock" "進入庫存資料維護功能表"
          CALL stock_menu()
        COMMAND "Reports" "進入報表功能表"
          CALL dummy()
        COMMAND "Exit" "結束"
          EXIT MENU
      END MENU
    END FUNCTION

    FUNCTION dummy()
      ERROR "功能尚未完成"
    END FUNCTION

  以下為stock次功能表選項的程式
    {MODULE stock_menu.4gl}
    GLOBALS "stores_globs.4gl"

    FUNCTION stock_menu()
      CALL stock_init() //開啟WINDOW及FORM，並顯示WINDOW

      MENU "Stock Menu"
        COMMAND "Query" "查詢資料"
          CALL dumy()
        COMMAND "Next" "顯示下一筆資料"
          CALL dummy()
        COMMAND "Previous" "顯示上一筆資料"
          CALL dummy()
        COMMAND "Add" "新增一筆資料"
          CALL input_stock()
        COMMAND "Update" "修改一筆資料"
          CALL update_stock()
        COMMAND "Delete" "刪除一筆資料"
          CALL delete_stock()
        COMMAND "Exit" "結束"
          EXIT MENU
      END MENU
      CLOSE WINDOW w_stock //將WINDOW關閉
    END FUNCTION

    FUNCTION stock_init()
      OPEN WINDOW w_stock AT 3,3
        WITH FORM "stock_form"
        ATTRIBUTE (BORDER)
      CURRENT WINDOW IS w_stock
      INITIALIZE nr_stock.* TO NULL
      LET gr_stock.*=nr_stock.*
    END FUNCTION

  以下為stock的新增資料功能
    {MODULE input_stock.4gl}
    GLOBALS "stores_globs.4gl"

    FUNCTION input_stock()
      DEFINE stock_count SMALLINT

      INPUT BY NAME gr_stock.*
        AFTER FIELD manu_code
          LET stock_count = 0
          SELECT COUNT(*) INTO stock_count FROM stock
            WHERE stock.stock_num = gr_stock.stock_num AND
              stock.manu_code = gr_stock.manu_code
          IF stock_count = 1 THEN
            ERROR "Stock No.", gr_stock.stock_num USING "<<<", 
            "under this Manu Code", gr_stock.manu_code, 
            "already existed. Please re-enter."
            NEXT FIELD manu_code
          END IF
      END INPUT

      INSERT INTO stock VALUES(gr_stock.*)
    END FUNCTION

  以下為stock的修改資料功能
    {MODULE update_stock.4gl}
    GLOBALS "stores_globs.4gl"

    FUNCTION update_stock()
      DEFINE stock_count SMALLINT

      DEFINE pkey_stock RECORD
        stock_num LIKE stock.stock_num,
        manu_code LIKE sotck.manu_code
      END RECORD

      WHILE TRUE
        PROMPT "Please input Stock No.:"
          FOR pkey.stock.stock_num
        PROMPT "Please input Manu Code:"
          FOR pkey.stock.manu_code
        SELECT COUNT(*) INTO stock_count FROM stock
          WHERE stock.stock_num = pkey.stock_num AND
            stock.manu_code = pkey.manu_code
        IF stock_count <> 1 THEN
          ERROR ""Stock No.",p_stock.stock_num USING "<<<<",
            "under this Manu Code", p_stock.manu_code,
            "doesn't existed. Please re-enter."
        ELSE
          SELECT * INTO gr_stock.* FROM stock
            WHERE stock.stock_num=pkey.stock_num AND
              stock.manu_code = pkey.manu_code
          EXIT WHILE
        END IF
      END WHILE

      INPUT BY NAME gr_stock.* WITHOUT DEFAULTS
        BEFORE FIELD stock_num
          NEXT FIELD description
      END INPUT

      UPDATE stock
        SET(description, unit_price, unit, unit_descr)
        =(gr.stock.description, gr_stock.unit_price, gr_stock.unit,gr_stock.unit_descr)
        WHERE stock.stock_num = pkey.stock_num AND stock.manu_code = pkey.manu_code

      MESSAGE "Stock NO.:", gr_stock.sotck_num USING "<<<<", "and Manufact code:", gr_stock.manucode, "has been updated."

    END FUNCTION

  以下為stock的刪除資料功能
    {MODULE delete_stock.4gl}
    GLOBALS "stores_globs.4gl"

    FUNCTION delete_stock()
      DEFINE stock_count SMALLINT

      DEFINE pkey_stock RECORD
        stock_num LIKE stock.stock_num,
        manu_code LIKE stock.manu_code
      END RECORD

      WHILE TRUE 
        PROMPT "Please input Stock No.:"
          FOR pkey.stock.stock_num
        PROMPT "Please input Manu Code:"
          FOR pkey.stock.manu_code
        SELECT COUNT(*) INTO stock_count FROM stock
          WHERE stock.stock_num = pkey.stock_num AND stock.manu_code = pkey.manu_code
        IF stock_count<>1 THEN
          ERROR ""Stock No,",p_stock.stock_num USING"<<<<",
          "under this Manu Code", p_stock.manu_code,"doesn't existed. Please re-enter."
        ELSE
          SELECT * INTO gr_stock.* FROM stock
            WHERE stock.stock_num = pkey.stock_num AND stock.manu_code = pkey.manu_code
          EXIT WHILE
        END IF
      END WHILE

      DISPLAY BY NAME gr_stock.*

      MENU "Are you sure you want to delete this record?"
        COMMAND "NO" "Do not delete this record."
          ERROR "Delete aborted." ATTRIBUTE(BLINK,BOLD)
          EXIT MENU
        COMMAND "YES" "Delete this record."
          DELETE FROM stock
            WHERE stock.stock_num = pkey.stock_num AND stock.manu_code = pkey.manu_code
          MESSAGE "Stock NO.:",gr_stock.stock_num
            USING "<<<<",
            "and Manufact code:", gr_stock.manu_code,"has been deleted."
          EXIT MENU
      END MENU
    END FUNCTION


中斷執行的控制
  INTERRUPT KEY(CONTROL-C)：完全結束程式
  DEFER INTERRUPT
    延遲使用者按INTERRPUT KEY後不馬上結束PROGRAM，並等待進一步指示
    只能寫在MAIN中，且一個PROGRAM只能出現一次
    INT_FLAG：系統內建變數，判別使用者是否按了INTERRUP KEY(TRUE=1)
    完成後必須人工的將INT_FLAG的值再設定回FALSE(=0)
    以下指令皆必須做INT_FLAG控制：CONSTRUCT, DISPLAY ARRAY, INPUT, INPUT ARRAY, MENU, PROMPT

  MAIN 部分
    {MODULE main.4gl}
    GLOBALS "stores_globs.4gl"

    MAIN
      DEFER INTERRUPT
      CALL prog_init()
      CALL main_menu()
    END MAIN
    ...省略

  記錄新增部分
    {MODULE main.4gl}
    GLOBALS "stores_globs.4gl"
    FUNCTION input_stock()
      DEFINE stock_count SMALLINT

      --必須將INT_FLAG的初始值設定為FALSE
        LET INT_FLAG = FALSE


      INPUT BY NAME gr_stock.*
        AFTER FIELD manu_code
          LET stock_count = 0
          SELECT COUNT(*) INTO stock_count FROM stock
            WHERE stock.stock_num = gr_stock.stock_num AND
              stock.manu_code = gr_stock.manu_code
          IF stock_count = 1 THEN
            ERROR "Stock No.", gr_stock.stock_num USING "<<<", 
            "under this Manu Code", gr_stock.manu_code, 
            "already existed. Please re-enter."
            NEXT FIELD manu_code
          END IF
      END INPUT

    --使用者若是按CONTROL-C結束INPUT的動作，
    --則INT_FLAG 的值會被設定為TRUE
      IF INT_FLAG = TRUE THEN
        LET INT_FLAG = FALSE
        ERROR "Data entry aborted."
        RETURN
      END IF

      INSERT INTO stock VALUES(gr_stock.*)
    END FUNCTION

  亦可對SQL指令做INTERRUPT動作，但必須在OPTIONS指令段中加入SQL INTERRUPT ON 的指令


GLOBALS Module
  //該GLOBAL FUNCTION主要將系統的總體變數(global variable)在此宣告，避免在每個單獨的MODULE宣告，造成系統總變數的不一致性
  //如其他MODULE需要用到這些global variable時，將此GLOBAL MODULE納入，如下所示
  // GLOBALS "stores_globs.4gl"


  {MODULE_1, stores_globs.4gl}
  DATABASE stores7  //主要放置此系統要連接的資料庫

  GLOBALS //是個獨立的FUNCTION，以GLOBALS宣告此FUNCTION的開始
    DEFINE gr_stock RECORD LIKE stock.*
    DEFINE nr_stock RECORD LIKE stock.*
  END GLOBALS //宣告此FUNCTION 的結束


4GL的CURSOR
  //CURSOR為資料記錄的一個指標
  由資料庫取出資料記錄到輸出於螢幕上，對於INFORMIX-4GL經過四個階段
    1、利用SQL指令由資料庫中擷取資料記錄(SELECT * FROM manufact)
    2、將上述結果存放到CUP中(可能是一筆，但更可能是多筆資料記錄)
    3、將CUP的資料記錄一次一筆的轉放到4GL變數中(可能利用DEFINE...RECORD訂出來的結構化型態的變數，gr_manufact.*)
    4、利用INPUT指令或是DISPLAY指令將4GL變數的值送到螢幕上的資料欄位
  在2、3階段時CURSOR(或POINTER)出現，稱為指標，指向一筆記錄在2符合SQL條件轉存到CPU中的資料記錄集(RECORDSET)，每個RECORDSET會有一個CURSOR，該CURSOR可被下達指令在RECORDSET間移動，利用此CURSOR完成3、4

  依照 CURSOR 在資料記錄集中 CURSOR 如何操作管理這些資料記錄
       當 CURSOR 在 RECORDSET 中移動時，這些資料記錄集的影響為何 分為下列三種
       (1) Scrolling CURRSOR
        該CURSOR一次指向一筆記錄
        該CURSOR在RECORDSET中，可由目前記錄向之前的記錄或向之後的記錄方向移動
        在CUP中產生一snapshot的暫存資料檔，故資料庫中資料記錄的改變並不會反映在此snapshot中
        通常此種CURSOR應用在查詢的功能方面

       (2)Non-Scrolling CURSOR
        該CURSOR一次指向一筆記錄
        該CURSOR在RECORDSET中，只能由目前記錄向之後的記錄方向移動
        在CUP中產生一snapshot的暫存資料檔，故資料庫中資料記錄的改變並不會反映在此snapshot中
        通常此種CURSOR應用在報表的功能方面

       (3)For Update CURSOR (Locking CURSOR)
        該CURSOR一次指向一筆記錄
        該CURSOR在RECORDSET中，只能由目前記錄向之後的記錄方向移動
        對於目前所指到的資料記錄會加以鎖住，直到該CURSOR移動到別筆資料記錄時，才會解鎖
        通常此種CURSOR應用在資料記錄修改或是資料記錄刪除功能方面

  使用CURSOR時的指令
    DECLARE：主要在宣告CURSOR用，CURSOR亦如變數般，必須要宣告後才能在後續的4GL程式中使用CURSOR
    OPEN：判別DECLARE CURSOR中的SELECT述句是否正確，並進一步建置CPU所需空間
    FETCH：將CURSOR目前所在資料記錄的值放入4GL變數中
    CLOSE：將該CURSOR所屬的RECORDSET關閉，在該指令後不能在使用此CURSOR，必須再執行一次OPEN指令
    FREE：釋放掉CURSOR所屬相關的CPU空間
    FOREACH：如FOR...END FOR指令一般，該指令形成一迴圈，但此迴圈指令屬於CURSOR的指令


SCROLLING CURSOR
  //將這些指令應用在查詢功能的程式中
  DECLARE
    目的是將經由SQL中SELECT敘述所取得的RECORDSET與一個CURSOR相連結，而此CURSOR的特性是可前後兩方向移動的(即可SCROLL)
    DECLARE cursor_name SCROLL CURSOR
      [WITH HOLD] FOR 
      SELECT_statement  //稱為RECORDSET

    DECLARE cust_ptr SCROLL CURSOR FOR
      SELECT * FROM customer

    DECLARE stock_ptr SCROLL CURSOR FOR
      SELECT stock_num, description FROM stock
        WHERE manu_code = 'ANZ'
        ORDER BY stock_num
    //WITH HOLD可避免此cursor_name因為一個TRANSACTION的結束而被CLOSE掉，使用WITH HOLD時，在程式結束前確定不再使用cursor_name，一定要下達CLOSE指令

  OPEN
    檢查SELECT_statement中指定的TABLE是否正確?欄位是否存在?使用者是否有足夠的權限存取該資料?
    決定符合SELECT敘述的RECORDSET
    建置該RECORDSET所需的記憶體空間

    OPEN cursor_name [USING variable_list]
    //該cursor_name必須已經DECLARE
    //USING variable_list 子句，主要是在RUN TIME時可依照當時的條件去選取資料

    OPEN cust_ptr

  FETCH
    擷取一筆資料記錄並將該記錄放置於4GL中
    FETCH [FIRST| NEXT| { PREVIOUS| PRIOR} | LAST| CURRENT| RELATIVE # |ABSOLUTE # ] //與CURSOR移動相關的指令
    cursor_name
    [INTO 4GL_program_variable]

    FETCH FIRST cust_ptr INTO gr_customer.*

    FETCH RELATIVE 1 cust_ptr INTO gr_customer.*

  CLOSE
    將該CURSOR所屬的RECORDSET關閉
    CLOSE cursor_name

    該指令下不能在使用FETCH指令去作用此CURSOR，如要使用在執行一次OPEN指令

    CLOSE cust_ptr

  FREE
    釋放掉該CURSOR所屬相關的CPU空間
    FREE cursor_name

    通常指令至於CLOSE cursor_name後

    FREE cust_ptr

  加入查詢的程式範例
    此MODULE為此PROGRAM的GLOBALS設定
      {MODULE_1, stores_globs.4gl}

      DATABASE stores7

      GLOBALS
        DEFINE gr_stock RECORD LIKE stock.*
        DEFINE nr_stock RECORD LIKE stock.*
      END GLOBALS

    以下MODULE為主功能表
      {MODULE main.4gl}
      GLOBALS "stores_globs.4gl"

      MAIN
        DEFER INTERRUPT ////
        CALL prog_init()
        CALL main_menu()
      END MAIN

      FUNCTION prog_init()
        OPTIONS
          INPUT WRAP //使用者必須按 ACCEP KEY或INTERRUPT KEY才能結束INPUT指令
      END FUNCTION

      FUNCTION main_menu()
        MENU "Main Menu:"
          COMMAND "Customer" "進入客戶資料維護功能表"
            CALL dummy()
          COMMAND "Orders" "進入訂單資料維護功能表"
            CALL dummy()
          COMMAND "Stock" "進入庫存資料維護功能表"
            CALL stock_menu()
          COMMAND "Reports" "進入報表功能表"
            CALL dummy()
          COMMAND "Exit" "結束"
            EXIT MENU
        END MENU
      END FUNCTION

      FUNCTION dummy()
        ERROR "功能尚未完成"
      END FUNCTION

    以下為stock次功能表選項的程式
      {MODULE menu.4gl}
      GLOBALS "stores_globs.4gl"

      FUNCTION stock_menu()
        CALL stock_init() //開啟WINDOW及FORM，並顯示WINDOW

        MENU "Stock Menu"
          BEFORE MENU ///
            HIDE OPTION ALL ///
            SHOW OPTION "Query", "Add", "Exit" ///先開放三個選項，直到使用者執行過Query後才開放其他的功能選項

            COMMAND "Query" "查詢資料"
              IF query_stock()=TRUE THEN ///
                SHOW OPTION "Next", "Previous", "Update", "Delete" ///
              ELSE ///
                HIDE OPTION ALL ///
                SHOW OPTION "Query", "Add", "Exit" ///
              END IF ///
            COMMAND "Next" "顯示下一筆資料"
              CALL nex_cust()
            COMMAND "Previous" "顯示上一筆資料"
              CALL prior_cust()
            COMMAND "Add" "新增一筆資料"
              CALL input_stock()
            COMMAND "Update" "修改一筆資料"
              CALL update_stock()
            COMMAND "Delete" "刪除一筆資料"
              CALL delete_stock()
            COMMAND "Exit" "結束"
              CALL clean_up() ///該FUNCTION主要CLOSE及FREE stock_ptr
              EXIT MENU
        END MENU
        CLOSE WINDOW w_stock //將WINDOW關閉
      END FUNCTION

      FUNCTION stock_init()
        OPEN WINDOW w_stock AT 3,3
          WITH FORM "stock_form"
          ATTRIBUTE (BORDER)
        CURRENT WINDOW IS w_stock
        INITIALIZE nr_stock.* TO NULL
        LET gr_stock.*=nr_stock.*
      END FUNCTION

    以下為stock的查詢功能
      {MODULE brws_stock.4gl}
      GLOBALS　"stores_globs.4gl"

      FUNCTION query_stock()
        DECLARE stock_ptr SCROLL CURSOR FOR
          SELECT * FROM stock
        OPEN stock_ptr ///open上述的CURSOR
        FETCH FIRST stock_ptr INTO gr_stock.* ///將第一筆資料記錄轉放到4GL程式變數中
          IF SQLCA.SQLCODE = NOTFOUND THEN ///判別前一個指令執行的結果
            ERROR "No rows found."
            CALL clean_up()  ///若無資料記錄符合條件，則CALL clean_up()，且傳回FALSE，該傳回值給上一MODULE的行12，query_stock()使用
            RETURN FALSE
          ELSE
            CALL display_stock() ///將CURRENT CURSOR資料顯示於螢幕上
            RETURN TRUE  ///該傳回值給上一MODULE的行12，query_stock()使用
          END IF
      END FUNCTION

      FUNCTION next_stock()///找下一筆資料
        FETCH NEXT sotck_ptr INTO gr_stock.*
        IF SQLCA.SQLCODE = NOTFOUND THEN ///判別前一個指令執行的結果
          ERROR "You are at the end of the data list."
        ELSE
          CALL display_stock()
        END IF
      END FUNCTION

      FUNCTION prior_stock() ///找上一筆資料
        FETCH PRIOR stock_ptr INTO gr_stock.*
        IF SQLCA.SQLCODE = NOTFOUND THEN ///判別前一個指令執行的結果
          ERROR "You are at the beginning of the data list."
        ELSE
          CALL display_stock()
        END IF
      END FUNCTION

      FUNCTION display_sotck()
        DISPLAY BY NAME gr_stock.* ///顯示資料
      END FUNCTION

      FUNCTION clean_up() ///如果使用者沒有選取Query選項就結束此功能表，此時程式執行到CLOSE、FREE時會出錯，因此加上此行防止異常狀況而當掉
        WHENEVER ERROR CONTINUE ///處理不正常狀況發生時，4GL的回應方式
          CLOSE stock_ptr
          FREE stock_ptr
        WHENEVER ERROR STOP ///處理不正常狀況發生時，4GL的回應方式
      END FUNCTION

    使用FETCH RELATIVE指令將上述MODULE中的next_stock()及prior_stock()改寫成為一個FUNCTION fetch_stock()，如下
      FUNCTION fetch_stock (fetch_flag)  ///利用此判斷傳進來的值為1或-1，進而移動CURSOR往後或往前一筆
        DEFINE fetch_flag SMALLING

        FETCH RELATIVE fetch_flag stock_ptr INTO gr_stock.*  ///利用此判斷傳進來的值為1或-1，進而移動CURSOR往後或往前一筆
        IF SQLCA.SQLCODE = NOTFOUND THEN
          IF fetch_flag=1 THEN
            ERROR "You are at the end of the data list."
          ELSE
            ERROR "You are at the beginning of the data list."
          END IF
        ELSE
          CALL display_stock()
        END IF
      END FUNCION

      ///由於利用傳值方式，所以在MODULE stock_menu.4gl中
      ///CALL next_cust()  改為 CALL fetch_stock(1)
      ///CALL prior_cust() 改為 CALL fetch_stock(-1)


QBE的查詢方式(Query by Example)
  CONSTRUCT
    提供使用者完成以下的輸入作業：可針對一連結到資料庫欄位的SCREEN FORM，輸入各種組合方式的值，經由4GL將這些組合方式轉換為SELECT敘述句的SQL

    CONSTRUCT
      BY NAME 4GL_program_variable ON table_column_list |  /// 組合一， CONSTRUCT + 此行 
      ///當SCREEN FORM 上的field_list 與 ON 後面所接的table_column_list有相同名稱時，可使用BY NAME而將screen_field_list省略不寫
      4GL_program_variable ON table_column_list FROM screen_field_list /// 組合二， CONSTRUCT + 此行，否則執行此行將名稱一一列出
      [ATTRIBUTE 子句]
      [HELP 輔助說明之編號]
      [input control block...
      END CONSTRUCT]
    有關行號6 [input control block...部分在此描述
    其中使用{} 並有 | 該符號者，表示被刮住部分為其中的選項
    BEFORE {(FIELD screen_field_list) | CONSTRUCT}
    AFTER  {(FIELD screen_field_list) | CONSTRUCT}
    ON KEY(按鍵，...)
    {4GL | SQL statement | NEXT FIELD
      {(screen_field_list) | NEXT | PREVIOUS} |
    {EXIT | CONTINU} CONSTRUCT }

    ///在所有語法中，只有兩行是必備的指令，其他均是選擇性的，有兩種組合如上所示
    ///使用CONSTRUCT前提必須要有FORM已被OPEN及DISPLAY，且該FORM是連結到資料庫
    ///DEFINE一個很長的CHAR VARIABLE(4GL_program_variable)，以承接USER輸入的查詢條件
    ///如果多個FORM已被開啟，一定要選擇正確的SCREEN FORM以讓CONSTRUCT指令使用，通常用CURRENT FORM指令指定該FORM

    CONSTRUCT 指令的動作解析
      (1)清除SCREEN FORM中所有與CONSTRUCT指令相關的SCREEN_field_list
      (2)若BEFORE CONSTRUCT control block存在，則先執行該block
      (3)移動輸入點到SCREEN FORM上第一個可輸入資料的欄位
      (4)允許使用者輸入資料(查詢條件)
      (5)等待使用者下達一確認查詢的訊息(使用者按ACCEPT KEY 或 GIVE UP KEY)
      (6)將使用者輸入的條件轉為SELECT中的WHERE條件(不包含SELECT部分)
        ///如果使用者沒有輸入任何條件於此SCREEN FORM上，則不會有WHERE條件存在

    DEFINE sql_qry CHAR(250)
    CONSTRUCT BY NAME sql_qry ON customer.*

    CONSTRUCT sql_qry ON stock.*
      FROM stock_num, manu_code, s_stock.*

    CONSTRUCT BY NAME sql_qry ON orders.*
      BEFORE FIELD order_no
        IF(customer_no = 999) THEN
          LET order_no = "999"
          NEXT FIELD NEXT
        END IF
      BEFORE FIELD order_date
        LET order_date = TODAY
        DISPLAY order_date TO q_date
    END CONSTRUCT

    AFTER CONSTRUCT
      IF NOT FIELD_TOUCHED(order.*) THEN
        MESSAE "You must indicate at least one","sellection criteria."
        CONTINUE CONSTRUCT
      END IF
      ///該例句使用IF NOT FIELD_TOUCHED(order.*)判別使用者是否沒有輸入任何查詢條件

  USER 執行 QBE 可使用之符號一覽表
    = ==  Equal to  ==x =x =
    : ..  Range  x:y x..y

  跟著下列步驟就可以順利完成一個QBE的查詢功能
    Step1 完成一個SCREEN FORM，該SCREEN FORM必須連結到資料庫 ( 完成customer_form.per 並產生 customer_form.frm )
    Step2 DEFINE variable_name CHAR(x)，x為一數字，且要夠大( 如200、250等 ; DEFINE sql_qry CHAR(300), where_qry CHAR(250) )
    Step3 OPEN且DISPLAY步驟1的SCREEN FORM( OPEN customer_form, DISPLAY customer_form)
    Step4 撰寫CONSTRUCT 敘述句( CONSTRUCT BY NAME where_qry ON customer.*)
    Step5 將sql_qry兜成一個完整的SELECT子句( LET sql_qry="SELECT fname,address1,city,state ","FORM customer ","WHERE ",where_qry CLIPPED)
                                //注意：每一列SQL結束與 " 之間要空一個字元
    Step6 完成一個PREPARE敘述( PREPARE ex_stm1 FROM sql_qry)  //注意：PREPARE後面的變數ex_stmt1不需要DEFINE
    Step7 對步驟6的PREPARE敘述DECLARE一個SCROLL CURSOR( DECLARE cust_ptr SCROLL CURSOR FOR ex_stmt1)
    Step8 後續按照 OPEN CURSOR以後的程序完成此QBE查詢功能的程式碼


QBE的合併單筆資料顯示
  {MODULE brws_stock.4gl}
  GLOBALS　"stores_globs.4gl"

  FUNCTION query_stock()
    DEFINE where_clause CHAR(250) ///
    DEFINE sql_ary CHAR(300) ///

    DISPLAY "" AT 1,1
    DISPLAY "" AT 2,1
    DISPLAY "Enter search criteria, and press ESC."

    LET INT_FLAG = FALSE 
    CONSTRUCT BY NAME where_clause ON stock.* ///
    IF INT_FLAG = TRUE THEN ///當使用者按CONTROL-C時，
      LET INT_FLAG = FALSE ///INT_FLAG = TRUE
      ERROR "Query aborted."
      RETURN FALSE
    END IF
    LET sql_qry="SELECT * FROM stock WHERE", ///
          where_clause CLIPPED, "ORDER BY manu_code" ///
    PREPARE ex_stm1 FROM sql_qry ///


    DECLARE stock_ptr SCROLL CURSOR FOR ///
      ex_stm1 ///
    OPEN stock_ptr /open上述的CURSOR
    FETCH FIRST stock_ptr INTO gr_stock.* /將第一筆資料記錄轉放到4GL程式變數中
      IF SQLCA.SQLCODE = NOTFOUND THEN /判別前一個指令執行的結果
        ERROR "No rows found."
        CALL clean_up()  /若無資料記錄符合條件，則CALL clean_up()，且傳回FALSE，該傳回值給上一MODULE的行12，query_stock()使用
        RETURN FALSE
      ELSE
        CALL display_stock() /將CURRENT CURSOR資料顯示於螢幕上
        RETURN TRUE  /該傳回值給上一MODULE的行12，query_stock()使用
      END IF
  END FUNCTION

  將上述功能強化，增加顯示依照使用者的條件擷取到多少筆符合之資料記錄
  {MODULE brws_stock.4gl}
  GLOBALS　"stores_globs.4gl"

  FUNCTION query_stock()
    DEFINE where_clause CHAR(250), 
         sql_ary CHAR(300),
         stock_cnt INTEGER ///將符合條件之總比數存放於此變數

    DISPLAY "" AT 1,1
    DISPLAY "" AT 2,1
    DISPLAY "Enter search criteria, and press ESC."

    LET INT_FLAG = FALSE 
    CONSTRUCT BY NAME where_clause ON stock.* /
    IF INT_FLAG = TRUE THEN /當使用者按CONTROL-C時，
      LET INT_FLAG = FALSE /INT_FLAG = TRUE
      ERROR "Query aborted."
      RETURN FALSE
    END IF
    --以下部分為挑選符合條件的資料
    LET sql_qry="SELECT * FROM stock WHERE", /
          where_clause CLIPPED ///
    PREPARE ex_stm1 FROM sql_qry /
    DECLARE stock_ptr SCROLL CURSOR FOR /
      ex_stm1 /

    --以下灰色部分為處理總比數部分  ///
    LET sql_qry="SELECT COUNT(*) FROM stock WHERE", ///
           where_clause CLIPPED ///
    OPEN stock_ptr /open上述的CURSOR
    FETCH FIRST stock_ptr INTO gr_stock.* /將第一筆資料記錄轉放到4GL程式變數中
      IF SQLCA.SQLCODE = NOTFOUND THEN /判別前一個指令執行的結果
        ERROR "No rows found."
        CALL clean_up()  /若無資料記錄符合條件，則CALL clean_up()，且傳回FALSE，該傳回值給上一MODULE的行12，query_stock()使用
        RETURN FALSE
      ELSE
        CALL display_stock() /將CURRENT CURSOR資料顯示於螢幕上
        PREPARE ex_stm2 FROM sql_qry
        DECLARE stock_count CURSOR FOR ex_stmt2
        OPEN stock_count
        FETCH stock_count INTO stock_cnt
        CLOSE stock_count
        FREE stock_count
        MESSAGE "There are", stock_cnt USING "<<<<",
            "rows selected."
        RETURN TRUE  /該傳回值給上一MODULE的行12，query_stock()使用
      END IF
  END FUNCTION

  提供CONSTRUCT段落中加入Control Block的部分程式片段
  CONSTRUCT BY NAME where_clause ON sotck.*
    BEFORE FIELD manu_code
      MESSAGE "Press CONTROL -M for a list of valid MANUFACT."
  --如果USER按CONTROL-M且目前輸入點在manu_code此欄位上，
  --則CALL另一個FUNCTION
    ON KEY (CONTROL -M)
      IF INFIELD(manu_code) THEN
        CALL manu_help()
      END IF

  --限制USER的單價部分，只能查看少於5000元的訂單資料
    AFTER FIELD unitprice
      LET unit_price = GET_FLDBUF(untiprice)
      IF unit_price>=5000 THEN
        ERROR "You don't have permission to query",
            "the @price greater than $5,000!"
        NEXT FIELD unitprice
      END IF
  --如果USER沒有輸入任何條件，即結束CONSTRUCT段落，
  --先確定USER是否真的要查看所有的資料記錄
    AFTER CONSTRUCT
      IF NOT FIELD_TOUCHED (stock.*) THEN
        PROMPT "Do you really want to see all stocks? (Y/N)"
          FOR CHAR answer
        IF answer MATCHES "[Nn]" THEN
          CONTINUE CONSTRUCT
          MESSAGE "Enter search criteria."
          NEXT FIELD stock_num
        END IF
      END IF
  END CONSTRUCT


FOR UPDATE CURSOR
  DECLARE
    主要是將經由SQL中SELECT敘述所取得的RECORDSET與一個CURSOR相連結，而此CURSOR的特性是當執行FETCH動作時，會將CURRENT CURSOR的資料記錄鎖住[即LOCK]

    DECLARE cursor_name CURSOR //cursor_name，為CURSOR的名字，會連結到RECORDSET，後續程式如要對RECORDSET作用，均須透過此cursor_name
      [WITH HOLD] FOR //WITH HOLD為選擇性語法，如在DECLARE CURSOR加上該語法，可避免cursor_name因TRANSACTION的結束(ROLLBACK, COMMIT WORK)而被CLOSE
              //如果在DECLARE CURSOR時使用WITH HOLD，程式結束前，不再使用此cursor_name，一定要下達CLOSE指令
      SELECT_statement //SQL指令可從資料庫指定的TABLE取得多筆資料記錄，後續稱為RECORDSET
      FOR UPDATE //宣告此cursor_name的特性為使用在資料記錄內容會改變的記錄指標
      //記錄指標最重要的特性為當FETCH CURSOR時，CURRENT CURSOR將會被鎖住，而不允許其他使用者再以FOR UPDATE CURSOR方式來FETCH此資料記錄

    DECLARE cust_ptr CURSOR FOR
        SELECT * FROM customer
          WHERE customer.customer_num = gr_customer.customer_num
    FOR UPDATE

  OPEN
    檢查第一項SELECT_statement中所指定的TABLE是否正確; 所指定的欄位是否存在 ; 使用者是否有足夠的權限存取該資料表
    決定符合SELECT敘述的RECORDSET
    建置該RECORDSET所需的記憶體空間
    
    OPEN cursor_name [USING variable_list]
    //cursor_name必須已經DECLARE
    //[USING variable_list]子句，主要在RUN TIME時可依照當時的條件去選取資料

    OPEN cust_ptr

  FETCH
    擷取一筆資料記錄並將之放置於4GL變數中，當CURSOR擷取到該資料記錄時會一併LOCK住該筆資料記錄

    FETCH[ FIRST | NEXT | { PREVIOUS | PRIOR} | LAST | CURRENT | RELATIVE # | ABSOLUTE #]
      cursor_name
      [INTO 4GL_program_variable]
    //須注意，FETCH CURSOR 時的LOCK行為
    //FETCH CURSOR時，會將該筆資料記錄LOCK，這個LOCK要一直到另一個FETCH時，會釋放掉該資料記錄
    //另一種釋放方式是執行CLOSE指令時

  CLOSE
    將CURSOR所屬的RECORDSET關閉

    CLOSE cursor_name
    //將該cursor_name所屬的RECORDSET關閉
    //在該指令後不能再使用FETCH指令去作用此CURSOR。如果要再使用此CURSOR，必須再一次執行OPEN指令
    //會釋放掉被LOCK的資料記錄

    CLOSE cust_ptr

  FREE
    釋放掉該CURSOR所屬相關的CPU空間
    
    FREE cursor_name

    釋放掉該CURSOR所屬相關的CPU空間
    通常該指令至於CLOSE cursor_name之後

    FREE cust_ptr

  //使用FOR UPDATE CURSOR指令時，若此DATAVASE有transaction logging，則必須在transaction中去OPEN及CLOSE此CURSOR
  //如果在DECLARE時使用WITH HOLD，就可以在transaction之外去OPEN及CLOSE此CURSOR。但FETCH動作還是必須在transaction中進行。

  範例
    {有關上述注意事項，舉完整案例如下}
    BEGIN WORK  //此乃transaction之開始
    ...
    DECLARE cursor_name CURSOR FOR
      select 子句
    FOR UPDATE
    FETCH cursor_name INTO 4GL_program_variable
    UPDATE
    CLOSE cursor_name
    FREE cursor_name
    ...
    IF.....
      ROLLBACK WORK  //此乃transaction之結束
    ELSE
      COMMIT WORK  //此乃transaction之結束
    END IF
    ...


記錄刪除使用CURSOR
  (1)對於被選定刪除的資料紀錄，加入LOCKING CURSOR
  (2)若為主檔的刪除，必須檢查對應的明細檔沒有資料才能允許刪除

  將刪除資料紀錄的選定，經由QBE查詢下來，不再提供輸入P-KEY的PROMPT指令做以下變更
    不需要stock_count變數
    不需要pkey_stock該組變數
    不需要WHILE TRUE提供輸入P-KEY的這一區段
    直接使用gr_stock.*該變數，因為選擇 "Query" 後，FETCH指令會將CURRENT CURSOR的值放置到gr_stock.*此變數中
    DECLARE一個LOCKING CURSOR，此段另外寫在update_init() 此FUNCTION中，因為在修改時可用此FUNCTION
      //將DECLARE CURSOR寫成一FUNCTION，從FUNCTION的角度來看可放置於此PROGRAM中的任一MODULE中
      //DECLARE CURSOR部分指令一定要與OPEN寫在同一個MODULE中，且必須要寫在OPEN指令之前，所以此FUNCTION決不可以置於OPNE指令之後
    OPEN、並且FETCH此lockstock到4GL_program_variable中
    將原來由資料庫刪除資料的 DELETE...WHERE... 部分改寫

  範例
    {MODULE} detele_stock.4gl
    GLOBALS "stores_globs.4gl"

    FUNCTION updel_init()
      DECLARE lockstock CURSOR FOR
        SELECT * FROM stocks
          WHERE stock.stock_num = gr_stock.stock_num AND
            stock.manu_code = gr_stock.manu_code
      FOR UPDATE
    END FUNCTION

    FUNCTION delete_stock()
      CALL updel_init() ///DECLARE一個LOCKING CURSOR
      OPEN lockstock
      FETCH lockstock INTO gr_stock.*
    --DISPLAY BY NAME gr_stock.*  ///由QBE下來，不需要再DISPLAY
      MENU "Are you sure you wnat to delete this record?"
        COMMAND "NO" "Do not delete this record."
          ERROR "Delete aborted." ATTRIBUTE (BLINK, BOLD)
          EXIT MENU
        COMMAND "YES" "Delete this record."
    --        DELETE FROM stock
    --          WHERE stock.stock_num = pkey.stock_num AND 
    --            stock.manu_code = pkey.manu_code
    --將原程式碼中的DELETE部分改寫成下列方式
          DELETE FROM stock
            WHERE CURRENT OF lockstock

          MESSAGE "Stock NO.:", gr_stock.stock_num
            USING "<<<<",
            "and Manufact code:", gr_stock.manu_code,
            "has been deleted."
          EXIT MENU
      END MENU
    END FUNCTION

    ///DELETE FROM ... WHERE CURRENT OF...，還是可以使用以4GL_program_variable與TABLE中比較的方式來刪除此筆資料。
    ///技術層面而言，使用WHERE CURRENT OF會有較好的執行效能，由其於OLTP環境中，所以WHERE CURRENT OF方式只能用在FOR UPDATE CURSOR


  由於sotck table為主檔，其之下的相關明細檔有items，所以必須檢查對應的明細檔沒有資料才能刪除，變更如下
    {MODULE} detele_stock.4gl
    GLOBALS "stores_globs.4gl"

    FUNCTION updel_init()
      DECLARE lockstock CURSOR FOR
        SELECT * FROM stocks
          WHERE stock.stock_num = gr_stock.stock_num AND
            stock.manu_code = gr_stock.manu_code
      FOR UPDATE
    END FUNCTION

    FUNCTION delete_stock()
      DEFINE items_count SMALLINT /*該變數主要記錄有多少筆相關的items資料記錄

      CALL updel_init() ///DECLARE一個LOCKING CURSOR
      OPEN lockstock
      FETCH lockstock INTO gr_stock.*
      SELECT COUNT(*) INTO items_count FROM items
        WHERE items.stock_num = gr_stock.stock_num
          AND items.manu_code = gr_stock.manu_code

      IF items_count>0 THEN
        ERROR "This Stock NO.:", gr_stock.stock_num
            USING "<<<<",
            "and Manufact code:", gr_stock.manu_code,
            "has placed", stock_count USING "<<<<",
            "order-item and can't be deleted."
      ELSE
        MENU "Are you sure you want to delete this record?"
          COMMAND "NO" "Do not delete this record."
            ERROR "Delete aborted." ATTRIBUTE (BLINK, BOLD)
            EXIT MENU
          COMMAND "YES" "Delete this record."
            DELETE FROM stock
              WHERE CURRENT OF lockstock


          MESSAGE "Stock NO.:", gr_stock.stock_num
            USING "<<<<",
            "and Manufact code:", gr_stock.manu_code,
            "has been deleted."
          EXIT MENU
        END MENU
      END IF
    END FUNCTION

    ///當同一筆資料同時被刪除，動作較慢的使用者會遇到執行當掉的現象(因為該資料記錄已被第一個使用者鎖住，下位使用者就不能再試圖去鎖住相同資料)
    ///如果第一次進入 "Delete" 選項，功能會正常執行，若回到上層功能表又再選一次該項，則會當掉不能正常執行(因為第一次結束該選項時沒有CLOSE lockstock此 CURSOR，因此再執行時 CALL updel_init() 會又 DECLARE lockstock此 CURSOR一次~~~可以在END FUNCTION前加入 CLOSE lockstock及FREE lockstock即可)
    ///如果使用者在確認刪除功能選項時按GIVE UP  KEY沒有作用


記錄修改使用CURSOR
  修改後的程式碼
    {MODULE main.4gl}
    GLOBALS "stores_globs.4gl"

    FUNCTION update_stock()
      CALL updel_init()  ///DECLARE一個LOCKING CURSOR，與刪除一樣CALL updel_init()此 DECLARE LOCKING CURSSOR部分

      OPEN lockstock ///
      FETCH lockstock INTO gr_stock.* ///
    --SELECT * INTO gr_stock.* FROM stock
    --  WHERE stock.stock_num = pkey.stock_num AND
    --    stock.manu_code = pkey.manu_code

      INPUT BY NAME gr_stock.description,  ///
              gr_stock.unit_price,  ///
              gr_stock.unit,   ///
              gr_stock.unit_descr  ///
      WITHOUT DEFAULTS   ///

      UPDATE stock
        SET(description, unit_price, unit, unit_descr)
          =(gr.stock.description THRU ///
            gr_stock.unit_descr) ///
        WHERE CURRENT OF lockstock ///改用執行較好的WHERE CURRENT OF 的寫法取代原P-KEY比較TABLE內欄位

      MESSAGE "Stock NO.:", gr_stock.sotck_num USING "<<<<", "and Manufact code:", gr_stock.manucode, "has been updated."
    END FUNCTION  

  因為一樣會遇到資料刪除的問題，改寫後如下
    {MODULE main.4gl}
    GLOBALS "stores_globs.4gl"

    FUNCTION update_stock()
          --CALL updel_init()  ///移除，放到stock_menu.4gl中，而delete_stock.4gl也要做相同的修改。如此進到stock_menu時，只要做DECLARE
      --該lockstock一次就好，在程式的維護是較好的寫法
      
      LET INT_FLAG = FALSE
      OPEN lockstock /
      FETCH lockstock INTO gr_stock.* /
    
      INPUT BY NAME gr_stock.description,  /
              gr_stock.unit_price,  /
              gr_stock.unit,   /
              gr_stock.unit_descr  /
      WITHOUT DEFAULTS   /

      IF INT_FLAG = TRUE THEN
        LET INT_FLAG = FALSE
        ERROR "Data update aborted."
        RETURN
      END IF

      UPDATE stock
        SET(description, unit_price, unit, unit_descr)
          =(gr.stock.description THRU ///
            gr_stock.unit_descr) ///
          WHERE CURRENT OF lockstock /

      MESSAGE "Stock NO.:", gr_stock.sotck_num USING "<<<<", "and Manufact code:", gr_stock.manucode, "has been updated."
    END FUNCTION  

  因為刪除 CALL updel_init()，因此要變動stock_menu.4gl該MODULE
      {MODULE menu.4gl}
      GLOBALS "stores_globs.4gl"

      FUNCTION stock_menu()
        CALL stock_init() 
        CALL updel_init()     ///在此處先DECLARE lockstock CURSOR

        MENU "Stock Menu"
          BEFORE MENU 
            HIDE OPTION ALL 
            SHOW OPTION "Query", "Add", "Exit" 
            COMMAND "Query" "查詢資料"
              IF query_stock()=TRUE THEN 
                SHOW OPTION "Next", "Previous", "Update", "Delete" 
              ELSE 
                HIDE OPTION ALL 
                SHOW OPTION "Query", "Add", "Exit" 
              END IF 
            COMMAND "Next" "顯示下一筆資料"
              CALL nex_cust()
            COMMAND "Previous" "顯示上一筆資料"
              CALL prior_cust()
            COMMAND "Add" "新增一筆資料"
              CALL input_stock()
            COMMAND "Update" "修改一筆資料"
              CALL update_stock()
            COMMAND "Delete" "刪除一筆資料"
              CALL delete_stock()
            COMMAND "Exit" "結束"
              CALL clean_up() 
              EXIT MENU
        END MENU
        CLOSE WINDOW w_stock 

      END FUNCTION

      FUNCTION stock_init()
        OPEN WINDOW w_stock AT 3,3
          WITH FORM "stock_form"
          ATTRIBUTE (BORDER)
        CURRENT WINDOW IS w_stock
        INITIALIZE nr_stock.* TO NULL
        LET gr_stock.*=nr_stock.*
      END FUNCTION

    ///須將upsate_stock.4gl與delete_stock.4gl兩個MODULE合併為一個MODULE


一些系統內建變數
  SQLCA
    Structured Query Language Communication Access 系統內定的總體變數
    資料型態為結構化資料型態
      DEFINE SQLCA RECORD
           SQLCODE  INTEGER,
           SQLERRM  CHAR(71),
           SQLERRP  CHAR(8),
           SQLERRD  ARRAY[6] OF INTEGER,
           SQLAWARN CHAR(8)
      END RECORD

      SQLCA.SQLCODE主要反映SQL指令執行後的結果
        SQLCA.SQLCODE = 0 表示執行成功
        SQLCA.SQLCODE = 100 [或是NOTFOUND] 表示執行成功但沒有符合條件的資料記錄被取出
        SQLCA.SQLCODE < 0 表示執行失敗 ，SQLCA.SQLCODE的值就是錯誤的代號，可在作業系統下以finderr # (#為代號) 查看詳細敘述
      SQLERRD[2]，主要在TABLE中為SERIAL型態時
        若使用INSERT INTO指令，可取得INSERT資料後該SERIAL欄位的值
        可反映ISAM的錯誤代號
      SQLERRD[4]，主要反映有多少筆資料記錄被執行INSERT 或 UPDATE
      通常必須在INSERT、UPDATE、DELETE或FETCH後加上 IF SQLCA.SQLCODE = 0 THEN ...的敘述
      通常必須在INSERT子句後，如此TABLE有SERIAL資料型態時，要寫出對此SERIAL欄位的值的顯示程式碼

  STATUS
    該系統變數與SQLCA.SQLCODE依樣可偵測SQL指令執行的結果，結果代號與SQLCA.SQLCODE一樣
    也可偵測4GL SCREEN I/O的錯誤
    當指定進入WHENVER ANY ERROR階段時，該變數可偵測到EXPRESSION的錯誤。如計算時，資料的溢位

  STATUS vs SQLCA.SQLCODE
    如作用在SQL指令時，均是反應執行結果
    如果作用在SQL指令時，只能夠使用STATUS
    由於SQLCA.SQLCODE是經由DBS的ENGINE傳回的值，所以會比STATUS(為4GL程式中GLOBAL VARIABLE)更有效率，較建議使用SQLCA.SQLCODE

  INSERT INTO customer VALUES(gr_customer.*)
  IF SQLCA.SQLCODE=0 THEN
    LET gr_customer.customer_num = SQLCA.SQLERRD[2]
    DISPLAY BY NAME gr_customer.customer.num
    MESSAGE "Customer No.", gr_customer.customer_num
      USING "<<<<", "is added."
  ELSE
    ERROR "Could not add customer data."
  END IF


WHENEVER ERROR
  告知4GL程式，當執行時期遇到錯誤發生時的反應

  WHENEVER(參考INFORMIX-4GL Reference Manual)
    主要在訂定4GL程式，當執行時期遇到錯誤發生時的反應方式
    //當加上ANY時，STATUS該變數才可處理一個4GL運算式的結果是否正確(甚少使用)
      WHENEVER [ANY] ERROR STOP
        為4GL系統預設的處理方式
        此語法會告知系統，當遇到錯誤狀況時，將錯誤訊息顯示在螢幕上，然後停止程式的執行

      WHENEVER [ANY] ERROR CONTINUE
        當遇到錯誤狀況時，避開此錯誤，程式繼續執行
        如果指定此種方式，卻沒做其他輔助處理，可能會造成無法彌補的錯誤
        通常會在有關SQL指令後加上SQLCA.SQLCODE的檢查

      WHENEVER [ANY] ERROR CALL function_name
        告知系統遇到錯誤狀況時執行一個FUNCTION，該FUNCTION可能是4GL提供的內建函數，也可能是自行撰寫的FUNCTION

      當訂定4GL遇到錯誤的處理方式不是 WHENEVER ERROR STOP時，在4GL程式COMPILE階段會在可能發生錯誤指令後，插入檢查碼及承接執行後的結果

      WHENEVER 的有效範圍是MODULE，但必須寫在WHENEVER後的指令才會以此方式處理發生的錯誤

  WHENEVER ERROR CALL function_name中系統內建可用的FUNCTION
    ERP_PRINT(vlaue)
      vlaue為負整數，通常為錯誤訊息代碼，常將SQLCA.SQLCODE置於此
      該FUNCTION會以value參考INFORMIX-4GL的ERROR MESSAGE LIBRARY，然後將錯誤訊息顯示於ERROR LINE
      若沒別的指令處理指令，程式會繼續執行下去
    ERP_QUIT(value)
      vlaue為負整數，通常為錯誤訊息代碼，常將SQLCA.SQLCODE置於此
      該FUNCTION會以value參考INFORMIX-4GL的ERROR MESSAGE LIBRARY，然後將錯誤訊息顯示於ERROR LINE
      程式停止
    Error Logging
      為一行為，將錯誤結果寫在LOG檔案中，必須經過下列三個步驟
        CALL STARTLOG("filname")  //有錯誤時寫進filename(檔案的路徑及檔名)，filename可不存在，系統會自動產生
        LET 4GL_program_variable = ERR_GET (value) 
          //放置於IF SQLCA.SQLCODE<0 THEN後，4GL_program_variable是4GL中DEFINE的CHAR變數，ERR_GET(value)透過value取得錯誤訊息
        CALL ERRORLOG(4GL_program_variable)  //可將4GL_program_variable變數值寫入filename

    以下範例程式主要凸顯WHENEVER ERROR的有效範圍是MODULE
      {以下為一個4GL MODULE}
      GLOBALS "stock_blobs.4gl"

      FUNCTION input_stock()
        INPUT BY NAME gr_stock.*
          ON KEY (CONTROL-E)
            CLEAR FORM
            LET gr_stock.* = nr_stock.*
            NEXT FIELD unit
        END INPUT

      WHENEVER ERROR CONTINUE
      INSERT INTO stock ///若此時遇到錯誤時程式會繼續執行
        VALUES (gr_stock.*) ///而且使用者並不知道資料無法新增
      END FUNCTION

      FUNCTION delete_stock()
        DELETE FROM stock
          WHERE stock.stock_num = gr_stock.stock_num AND
                stock.manu_code = gr_stock.manu_code
      --由於WHENEVER ERROR CONTINUE 的效力依舊存在，所以當DELETE無法成功執行時不會停止，以下程式會顯示訊息給使用者知道：刪除失敗
        IF SQLCA.SQLCODE < 0 THEN
          ERROR SQLCA.SQLCODE USING "-<<<<", "has occurred."
        ELSE
          MESSAGE "This sotck data has been deleted."
        END IF
      END FUNCTION

    以下程式範例主要顯示WHENEVER ERROR CALL自定函數的寫法
      {以下為一個4GL MODULE}
      GLOBALS "stock_blobs.4gl"

      FUNCTION input_stock()
      --在WHENEVER ERROR CALL db_erro中，指定當錯誤產生時，
      --都去呼叫db_error [此為一個自定函數]
      --注意:CALL db_error 時不能加()

        WHENEVER ERROR CALL db_error
        INPUT BY NAME gr_stock.*
          ON KEY(CONTROL-E)
            CLEAR FORM
            LET gr_stock.* = nr_Stock.*
            NEXT FIELD unit
        END INPUT
      --在行號 INSERT INTO stock 和 DELETE FROM stock中，當系統COMPILE時均會檢查
      --WHENEVER的設定為何
      INSERT INTO stock
        VALUES (gr_stock.*)
      END FUNCTION

      FUNCTION delete_stock()
        DELETE FROM stock
          WHERE stock.stock_num = gr_Stock.stock_num AND
                stock.manu_code = gr_stock.manu_code
      END FUNCTION

      FUNCTION db_error()
        ERROR SQLCA.SQLCODE, "has occurred."
        ...
      END FUNCTION

    以下程式範例，主要介紹Error Logging的寫法
      ...
      MAIN
        CALL STARTLOG("/u/shu/error_file")
        ...
      END MAIN

      FUNCTION add_cust()
        DEFINE errvar CHAR(80)  ///該變數將存放錯誤訊息及相關資訊
        DEFINE p_user CHAR(10)  ///該變數預計取得 USER ID
        WHENEVER ERROR CONTINUE
        LET p_user = FGL_GETENV("USER")  ///利用FGL_GENTENV()我們可取得USERID
          ...
        INPUT BY NAME gr_customer.*
        INSERT INTO customer VALUES(gr_customer.*)

      --若執行INSERT INTO 錯誤發生時，則將錯誤寫入LOG FILE
        IF SQLCA.SQLCODE < 0 THEN
          LET errvar = "USER:", p_user CLIPPED, "ERROR NO.: ",
                    SQLCA.SQLCODE USING "-<<<<",
                    ERR_GET (SQLCA.SQLCODE)
          CALL ERRORLOG (ERRVAR clipped)
          error ERRVAR clipped
        END IF
      END FUNCTION


何謂 TRANSACTION(未完...待續)
  為一個行動，該行動中包含一連串的動作，主要在處理相關TABLE的欄位資料時保有一致性，並確保TRANSACTION執行時不被其他的TRANSACTION影響
  BEGIN WORK... ROLLBACK WORK... COMMIT WORK
    BEGIN WORK：表起始  ROLLBACK WORK或COMMIT WORK：表結束
    BEGIN WORK... ROLLBACK WORK
    BEGIN WORK... COMMIT WORK
    BEGIN WORK... ROLLBACK WORK... COMMIT WORK：同時使用時必須使用條件式(IF...THEN...ELSE...END IF)
    BEGIN WORK後與資料庫相關寫入動作會馬上寫入資料庫，而是記錄到LOG FILE
    執行到ROOLBACKWORK，DATABASE SERVER會取消並結束TRANSACTION，BEGIN WORK到ROLLBACK WORK間對於DATABASE的寫入動作均不算數
    執行到COMMIT WORK，DATABASE SERVER會結束TRANSACTION，BEGIN WORK到COMMIT WORK間對於DATABASE的寫入動作均成立

    例句  
      (1) BEGIN WORK
                UPDATE saving SET balance = balance-100
                UPDATE checking SET balance = balance+100
          COMMIT WORK

      (2) BEGIN WORK
                LET tran_flag = TRUE
                UPDATE saving SET balance = balance-100
                  IF balance<0 THEN
                    LET tran_flag =FALSE
                  END IF 
                UPDATE checking SET balance = balance+100
                  IF row_locked THEN
                    LET tran_flag = FALSE
                  END IF
                IF tran_flag = false THEN
                  ROLLBACK WORK
                ELSE
                  COMMIT WORK
                END IF
          ---使用一自訂變數tran_flag來記錄每一個UPDATE動作成功與否及saving的balance[餘額]是否少於0； 如果不成功或少於0，則tran_flag設定為FALSE。然後使用IF..ELSE..END IF判別tran_flag的值，只要以上狀況有一發生時，則所有的UPDATE動作均不成立

    未完待續...10-32



產生REPORT DRIVER
  //可執行的4GL報表，在程式撰寫分成兩部分
    產生REPORT DRIVER的指令，通常寫在主程式中，如MENU的COMMAND
    另一為REPORT的主體，在此會制定報表的格式，通常此部分會獨立成一個FUNCTION
  //4GL REPORT的終端輸出媒體可為檔案、螢幕 或印表機

  START REPORT指令
    開始進入流程，可指定報屌的終端輸出媒體，並訂定報表的頁面配置

    {以下三行為START REPORT的語法}
    START REPORT report_name
      [TO 子句]
      [WITH 頁面配置]
    以下為[TO 子句]
    TO
      {SCREEN | PRINTER | [FILE] file_name} |    //螢幕|印表機|特定檔案
      {PIPE program [IN FORM |IN LINE] [MODE]} |  //特定program或是shell script或是command line，通常是送到unix的pipe
      OUTPUT destination_子句
    以下為destination_子句 的詳細語法
    {variable_name | "SCREEN" | "PRINTER"} |
    {{variable_name | "FILE" | "PIPE[(IN FORM | IN LINE) MODE]"}
      {DESTINATION "program_name" | "file_name"}}
    以下為頁面配置的詳細語法
    PAGE LENGTH[=] #
    TOP MARGIN[=] #
    BOTTOM BARGIN[=] #
    RIGHT MARGIN[=] #
    LEFT MARGIN[=] #
    TOP OF PAGE[=] "string"

    例句
      START REPORT cust_rpt TO SCREEN
      START REPORT cust_rpt TO "cust_file"
      START REPORT cust_rpt TO PIPE "/usr/a01/more"
      START REPORT cust_rpt TO OUTPUT "PIPE" DESTINATION "/usr/a01/more"
      START REPORT cust_rpt TO PIPE "/usr/a01/more" IN FORM MODE
      START REPORT cust_rpt TO OUTPUT "PIPE IN LINE MODE" DESTINATION "/usr/a01/more"
      START REPORT cust_rpt TO OUTPUT "SCREEN"

      此例句是一個完整卻特殊的案例
        DATABASE stores7
        MAIN
          DEFINE p_customer RECORD LIKE customer.*
          DECLARE r_cust CURSOR FOR SELECT * FROM customer
          START REPORT cust_rpt TO　"cust_file"  ///會以目前輸出到檔案為主，會以START REPORT為主，此行設定會覆蓋掉 OUTPUT REPORT TO PRINTER的設定
          FOREACH r_cust INTP p_customer.*
            OUTPUT TO REPORT cust_Rpt (p_customer.*)
          END FOREACH
          FINISH REPORT cust_rpt
        END MAIN
        {以下為報表主體部分}
        REPORT cust_rpt(r_customer)
          DEFINE r_customer RECORD LIKE customer.*
          OUTPUT REPORT TO PRINTER
          FORMAT EVERY ROW
        END REPORT

  OUTPUT TO REPORT指令
    傳遞一單筆組資料到REPORT FUNCTION中
    OUTPUT TO REPORT report_name(4GL 運算式,...)  
        //主要將與法中的()的資料傳遞到report_name此REPORT FUNCTION中
        //()中的資料對於REPORT FUNCTION稱為input reocrd，此處input record需要能與REPORT FUNCTION的被傳遞參數個數一致，資料型態部分也須能相對應
        //(4GL 運算式,...)  可以是變數、常數或是系統變數，也可以是TEXT或BYTE的資料型態，但此類型在傳遞時，是傳其參考位置，而非傳資料本身，多個運算式用逗點一一隔開

      //以下FUNCTION主要在指定進入4GL REPORT的流程，且定義一個CURSOR以取得customer table中符合條件的資料，如第二行，再利用FOREACH...END FOREACH語法將CURSOR中的資料一筆一筆送入cust_list此REPORT FUNCTION中(如 OUTPUT TO REPORT cust_list(gr_customer.*))
      FUNCTION cust_driver()
        DECLARE q_curs CURSOR FOR SELECT * FROM customer
        START REPORT cust_list TO "cust_list.out"
        FOR EACH q_curs INTO gr_customer.*
          OUTPUT TO REPORT cust_list(gr_customer.*)
        END FOREACH
        FINISTH REPORT cust_list
      END FUNCTION

      REPORT cust_list(r_customer)
        DEFINE r_customer RECORD LIKE customer.*
        FORMAT EVERY ROW
      END REPORT

  FINISH REPORT指令 
    促使4GL REPORT結束其作業流程

    FINISH REPORT report_name

    如果有屬於全體資料紀錄的運算，如 COUNT(*), PERCENT(*), 將會去完成此部分
    執行任何AFTER GROUP OF control block的作業
    執行任何PAGE HEADER, ON LAST ROW 及 PAGE TRAILER control blocks的作業
    將輸出暫存區的資料COPY到實際指定的終端輸出媒體
    關閉任何因應ORDER BY 或 AGGREGATE FUNCTION所產生的暫存檔的CURSOR
    如果有因為BYTE或TEXT所佔有的記憶體空間，也會在此時被釋放掉
    最後中止4GL REPORT，並將DATABASE中因為AGGREGATE FUNCTION所產生的暫存檔刪掉



撰寫REPORT FUNCTION
  REPORT FUNCTION的寫法
  DEFINE Seciton
  OUTPUT Section
  ORDER BY Section
  FORMAT Section
  AFTER GROUP OF Control Block
  BEFORE GROUP OF Control Block
  FIRST PAGE HEADER Control Block
  PAGE HEADER Control Block
  ON EVERY ROW
  PAGE TRAILER Control Block
  ON LAST ROW Control Block


FORMAT Section中的指令
  EXIT REPORT
  NEED
  PAUSE
  PRINT
  SKIP


FORM中的SCREEN ARRAY


4GL的INPUT ARRAY
  DEFINE ARRAY VARIABLE
  LET
  CLEAR
  INPUT ARRAY


4GL的DISPLAY ARRAY 與內建函數
  DISPLAY ARRAY
  內建函數