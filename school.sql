-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： sql304.infinityfree.com
-- 產生時間： 2025 年 06 月 02 日 02:25
-- 伺服器版本： 10.6.19-MariaDB
-- PHP 版本： 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `if0_39080928_school`
--

-- --------------------------------------------------------

--
-- 資料表結構 `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `bookname` varchar(64) NOT NULL COMMENT '書名',
  `author` varchar(64) NOT NULL COMMENT '作者',
  `publisher` varchar(64) NOT NULL COMMENT '出版社',
  `pubdate` date NOT NULL COMMENT '出版日期',
  `price` int(11) NOT NULL COMMENT '定價',
  `content` text NOT NULL COMMENT '內容說明'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `book`
--

INSERT INTO `book` (`id`, `bookname`, `author`, `publisher`, `pubdate`, `price`, `content`) VALUES
(2, '數學之美', '王小明', '數學出版社', '2019-08-15', 420, '本書深入淺出地介紹了數學在日常生活中的應用，從生活中的例子入手。'),
(3, '大數據分析', '張博', '科技出版社', '2021-02-05', 499, '這本書介紹了大數據分析的基礎理論和實踐方法，適合數據科學領域的學習者。'),
(4, '機器學習實戰', '劉莉', '科學出版社', '2020-11-20', 520, '本書涵蓋了機器學習的各種算法及其實際應用，詳細介紹了如何實踐機器學習。'),
(5, '人類簡史', '尤瓦爾·赫拉利', '時代出版', '2018-09-18', 399, '本書探討了人類歷史的起源，從史前時代到現代社會的演變過程。'),
(6, '無聲告白', '張佳玮', '文學出版社', '2017-03-22', 280, '這是一本關於家庭關係的小說，透過不同視角呈現了一個家庭的故事。'),
(7, '圍城', '錢鍾書', '人民文學出版社', '2015-06-01', 199, '本書是一部現代小說，講述了中國知識分子生活的複雜性與矛盾。'),
(8, '資本論', '卡爾·馬克思', '人民出版社', '2014-05-12', 650, '本書是馬克思的經典之作，詳盡分析了資本主義經濟體系的運作方式。'),
(9, '毛澤東選集', '毛澤東', '中共中央文獻出版社', '2016-07-01', 300, '這本書是毛澤東的選集，包含了其在不同歷史時期的演講和著作。'),
(10, '人生海海', '張愛玲', '上海文藝出版社', '2010-02-20', 240, '本書是一部以女性視角講述現代都市生活的小說，展現了張愛玲獨特的寫作風格。'),
(11, '愛的藝術', '艾瑞克·弗洛姆', '心理學出版社', '2013-11-13', 270, '這本書探討了愛的本質，從心理學和哲學的角度分析了愛的各種形式。'),
(12, '時間簡史', '史蒂芬·霍金', '科學出版社', '2002-08-10', 420, '這是霍金關於宇宙學的經典著作，探討了宇宙的起源、結構和未來。'),
(13, '活著', '余華', '作家出版社', '1999-12-01', 150, '這本小說描述了一個普通人一生中的悲歡離合，揭示了生命的堅韌與價值。'),
(14, '隨機漫步的傻瓜', '納西姆·尼古拉斯·塔勒布', '金融出版社', '2008-09-20', 399, '本書探討了隨機性在金融市場和生活中的影響，挑戰了人類對未來的預測。'),
(15, '思考，快與慢', '丹尼爾·卡尼曼', '心理學出版社', '2012-10-15', 460, '這本書介紹了人類思維的兩種系統，並探索了決策過程中的心理學原理。'),
(16, '邏輯學基礎', '張振鋒', '教育出版社', '2015-04-01', 220, '本書系統介紹了邏輯學的基本概念和方法，適合邏輯學入門學習者。'),
(17, '解憂雜貨店', '東野圭吾', '日本文學出版社', '2017-07-25', 350, '這本書是一部溫馨的小說，講述了三位主人公如何解決他人的困惑和問題。'),
(18, '人類的故事', '亨利·大衛·梭羅', '歷史出版社', '2014-04-10', 290, '本書講述了人類文明的發展歷程，從古代文明到現代社會的演變過程。'),
(19, '萬物簡史', '比爾·布萊森', '科學文化出版社', '2015-09-01', 330, '這本書簡明扼要地介紹了宇宙、地球及生物學等領域的發展歷史。'),
(20, '海邊的卡夫卡', '村上春樹', '文學出版社', '2005-06-16', 380, '本書是一部結合了現實與幻想的小說，講述了青少年卡夫卡的成長故事。'),
(23, 'ddd', 'ddd', 'ddd', '2025-02-26', 80, 'fffffffff'),
(24, 'ffff', 'fff', 'fff', '2025-02-28', 11111, 'fffff'),
(25, '55', '22', '22', '2025-06-13', 22, '222');

-- --------------------------------------------------------

--
-- 資料表結構 `cafes`
--

CREATE TABLE `cafes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `open_date` date DEFAULT NULL,
  `avg_price` int(11) DEFAULT NULL,
  `features` mediumtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `cafes`
--

INSERT INTO `cafes` (`id`, `name`, `address`, `open_date`, `avg_price`, `features`) VALUES
(1, '????', '???????1?', '2017-04-20', 166, '??Wi-Fi, ????, ????'),
(2, '?????', '???????2?', '2021-01-20', 173, '????, ????, ????'),
(3, '????', '???????3?', '2023-04-08', 167, '????, ????, ????'),
(4, '???????', '???????4?', '2020-11-20', 149, '??Wi-Fi, ????, ????'),
(5, '?????', '???????5?', '2018-09-09', 111, '????, ????, ??Wi-Fi'),
(6, '????', '???????6?', '2019-06-25', 135, '???, ????, ????'),
(7, '?????', '??????7?', '2022-02-15', 190, '???, ??Wi-Fi, ???'),
(8, '??????', '??????8?', '2023-08-30', 185, '????, ???, ????'),
(9, '?????', '??????9?', '2021-10-10', 152, '???, ????, ????'),
(10, '??????', '??????10?', '2016-05-03', 178, '?????, ????, ????'),
(11, '??????', '??????11?', '2020-12-25', 160, '???, ????, ???'),
(12, '?????', '???????12?', '2019-03-19', 195, '????, ????, ????'),
(13, '?????', '???????13?', '2021-07-07', 169, '????, ????, ????'),
(14, '??????', '???????14?', '2020-10-10', 130, '????, ????, ????'),
(15, '????', '???????15?', '2023-03-22', 140, '???, ??Wi-Fi, ???'),
(16, '????', '???????16?', '2022-06-11', 175, '????, ????, ????'),
(17, '?????', '???????17?', '2018-04-30', 162, '????, ???, ???'),
(18, '????', '??????18?', '2017-12-12', 150, '???, ??Wi-Fi, ????'),
(19, '????', '??????19?', '2020-03-03', 174, '????, ????, ??'),
(20, '????', '???????20?', '2019-09-15', 180, '???, ???, ??Wi-Fi'),
(21, '????', '???????21?', '2021-09-01', 158, '????, ????, ????'),
(22, '?????', '???????22?', '2022-01-01', 188, '????, ????, ????'),
(23, '?????', '??????23?', '2023-05-05', 145, '???, ?????, ????'),
(24, '?????', '???????24?', '2020-08-20', 172, '????, ????, ????'),
(25, '??????', '??????25?', '2018-10-11', 160, '???, ????, ???'),
(26, '????', '???????26?', '2019-07-20', 177, '????, ????, ??Wi-Fi'),
(27, '?????', '??????27?', '2021-06-06', 169, '??????, ???, ???'),
(28, '?????', '???????28?', '2023-01-10', 144, '????, ???, ????'),
(29, '?????', '??????29?', '2022-09-09', 150, '????, ????, ???'),
(30, '????', '???????30?', '2018-02-14', 155, '????, ????, ??Wi-Fi');

-- --------------------------------------------------------

--
-- 資料表結構 `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL COMMENT '主鍵',
  `title` varchar(64) NOT NULL COMMENT '電影名稱',
  `year` int(4) NOT NULL COMMENT '發行年份',
  `director` varchar(64) NOT NULL COMMENT '導演',
  `mtype` varchar(16) NOT NULL COMMENT '類型',
  `mdate` date NOT NULL COMMENT '首映日期',
  `content` text NOT NULL COMMENT '內容簡介'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `movie`
--

INSERT INTO `movie` (`id`, `title`, `year`, `director`, `mtype`, `mdate`, `content`) VALUES
(1, 'Inception', 2010, 'Christopher Nolan', '科幻', '2010-07-16', '一場關於潛意識的任務冒險。'),
(2, 'The Godfather', 1972, 'Francis Ford Coppola', '犯罪', '1972-03-24', '黑幫家族的興衰史。'),
(3, 'Spirited Away', 2001, 'Hayao Miyazaki', '動畫', '2001-07-20', '少女進入神靈世界的奇幻之旅。'),
(4, 'Parasite', 2019, 'Bong Joon-ho', '劇情', '2019-05-30', '探討貧富差距的諷刺黑色喜劇。'),
(5, 'The Dark Knight', 2008, 'Christopher Nolan', '動作', '2008-07-18', '蝙蝠俠對抗小丑的故事。'),
(6, 'Titanic', 1997, 'James Cameron', '愛情', '1997-12-19', '一場悲劇下的浪漫故事。'),
(7, 'Interstellar', 2014, 'Christopher Nolan', '科幻', '2014-11-07', '穿越宇宙尋找新家園。'),
(8, 'Coco', 2017, 'Lee Unkrich', '動畫', '2017-11-22', '音樂與亡靈節的感人故事。'),
(9, 'Avengers: Endgame', 2019, 'Anthony Russo', '英雄', '2019-04-26', '終局之戰，英雄集結。'),
(10, 'The Matrix', 1999, 'Lana Wachowski', '科幻', '1999-03-31', '現實與虛擬世界的對抗。'),
(11, 'Your Name', 2016, 'Makoto Shinkai', '動畫', '2016-08-26', '時空交錯的戀愛故事。'),
(12, 'La La Land', 2016, 'Damien Chazelle', '音樂', '2016-12-09', '夢想與愛情的交織。'),
(13, 'Joker', 2019, 'Todd Phillips', '心理', '2019-10-04', '社會邊緣人的崩壞旅程。'),
(14, 'Toy Story', 1995, 'John Lasseter', '動畫', '1995-11-22', '玩具們的冒險旅程。'),
(15, 'A Silent Voice', 2016, 'Naoko Yamada', '動畫', '2016-09-17', '關於霸凌與救贖的故事。'),
(16, 'The Lion King', 1994, 'Roger Allers', '動畫', '1994-06-24', '獅子王的成長冒險。'),
(17, 'Frozen', 2013, 'Chris Buck', '動畫', '2013-11-27', '冰雪女王與妹妹的羈絆。'),
(18, 'Her', 2013, 'Spike Jonze', '愛情', '2013-12-18', '男人與AI的戀愛故事。'),
(19, 'The Notebook', 2004, 'Nick Cassavetes', '愛情', '2004-06-25', '刻骨銘心的愛情回憶。'),
(20, '1917', 2019, 'Sam Mendes', '戰爭', '2019-12-25', '一鏡到底的戰地任務。'),
(21, 'Dune', 2021, 'Denis Villeneuve', '科幻', '2021-10-22', '星際間的權力爭鬥。'),
(22, 'Soul', 2020, 'Pete Docter', '動畫', '2020-12-25', '關於靈魂與人生意義的探討。'),
(23, 'Up', 2009, 'Pete Docter', '動畫', '2009-05-29', '老爺爺的熱氣球冒險。'),
(24, 'Tenet', 2020, 'Christopher Nolan', '科幻', '2020-08-26', '時間逆轉的諜報行動。'),
(25, 'Fight Club', 1999, 'David Fincher', '心理', '1999-10-15', '挑戰現代社會的瘋狂邏輯。'),
(26, 'The Shawshank Redemption', 1994, 'Frank Darabont', '劇情', '1994-09-23', '越獄與希望的經典故事。'),
(27, 'Whiplash', 2014, 'Damien Chazelle', '音樂', '2014-10-10', '極限追夢與師生對抗。'),
(28, 'Gravity', 2013, 'Alfonso Cuarón', '科幻', '2013-10-04', '太空求生的極限挑戰。'),
(29, 'The Social Network', 2010, 'David Fincher', '劇情', '2010-10-01', '臉書創辦的背後故事。'),
(30, 'Blade Runner 2049', 2017, 'Denis Villeneuve', '科幻', '2017-10-06', '人性與機器的模糊界線。'),
(31, '4', 4, '4', '4', '2025-04-09', '4');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL COMMENT '識別代號',
  `pname` varchar(64) NOT NULL COMMENT '產品名稱',
  `pspec` varchar(64) NOT NULL COMMENT '產品規格',
  `price` int(11) NOT NULL COMMENT '產品定價',
  `pdate` date NOT NULL COMMENT '製作日期',
  `content` text NOT NULL COMMENT '內容說明'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`id`, `pname`, `pspec`, `price`, `pdate`, `content`) VALUES
(1, '咖啡杯', '300ml 陶瓷', 250, '2025-01-01', '耐高溫、經典白色設計'),
(2, '鋼筆', '金屬筆身', 1200, '2025-01-03', '書寫滑順，附贈墨水匣'),
(3, '筆記本', 'A5 橫線', 80, '2025-01-05', '適合日常筆記'),
(4, '藍牙耳機', '無線入耳式', 1890, '2025-01-07', '支援降噪功能'),
(5, '手機殼', 'iPhone 14', 350, '2025-01-09', '防摔抗震材質'),
(6, '滑鼠', '無線雷射', 690, '2025-01-10', '人體工學設計'),
(7, '鍵盤', '機械式RGB', 2300, '2025-01-11', '青軸手感'),
(8, '行動電源', '10000mAh', 799, '2025-01-12', '支援快充'),
(9, 'USB 隨身碟', '64GB 3.0', 399, '2025-01-13', '高速傳輸'),
(10, '水壺', '500ml 不鏽鋼', 520, '2025-01-14', '保溫長達12小時'),
(11, '便當盒', '雙層304不鏽鋼', 780, '2025-01-15', '適合微波爐'),
(12, '背包', '多功能防潑水', 1580, '2025-01-16', '內建筆電夾層'),
(13, '原子筆', '0.5mm 黑色', 20, '2025-01-17', '滑順不斷墨'),
(14, '耳罩耳機', '降噪包耳式', 2680, '2025-01-18', '適合長時間使用'),
(15, '手機支架', '桌上型', 150, '2025-01-19', '自由調整角度'),
(16, '投影機', '1080p 家用', 3980, '2025-01-20', '高亮度畫質'),
(17, '筆電散熱墊', '雙風扇', 450, '2025-01-21', '提升散熱效率'),
(18, '資料夾', '透明A4', 15, '2025-01-22', '適合歸檔文件'),
(19, '掃地機器人', '智能導航', 6800, '2025-01-23', '自動回充'),
(20, '電暖器', '陶瓷加熱', 2200, '2025-01-24', '冬日必備'),
(21, '燈條', 'LED RGB', 320, '2025-01-25', '可手機遙控'),
(22, '相框', '6x8 木製', 180, '2025-01-26', '簡約風格'),
(23, '洗臉機', '音波震動', 980, '2025-01-27', '溫和清潔毛孔'),
(24, '牙刷', '電動震動式', 550, '2025-01-28', '內建計時功能'),
(25, '濾水壺', '1.5L 附濾芯', 990, '2025-01-29', '可過濾氯與雜質'),
(26, '筆電支架', '鋁合金可折疊', 620, '2025-01-30', '減少肩頸負擔'),
(27, '運動手環', '心率偵測', 1980, '2025-02-01', '支援通知功能'),
(28, '行李箱', '24吋鋁框', 3280, '2025-02-02', '耐撞防刮材質'),
(29, '智慧手錶', '支援iOS/Android', 4980, '2025-02-03', '多功能健康追蹤'),
(30, '記事貼', '多色便利貼', 60, '2025-02-04', '方便分類提醒'),
(31, 'ddd', 'ddd', 111, '2025-04-08', '111');

-- --------------------------------------------------------

--
-- 資料表結構 `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `schid` varchar(12) NOT NULL COMMENT '學號',
  `name` varchar(32) NOT NULL COMMENT '姓名',
  `gender` varchar(1) NOT NULL COMMENT '性別',
  `birthday` date NOT NULL COMMENT '生日',
  `email` varchar(64) NOT NULL COMMENT '電子郵件',
  `address` varchar(64) NOT NULL COMMENT '住址'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `student`
--

INSERT INTO `student` (`id`, `schid`, `name`, `gender`, `birthday`, `email`, `address`) VALUES
(0, '111', '11', 'M', '2025-03-14', '11@gg', '11'),
(1, 'S1000000001', '張三', 'M', '2000-01-15', 'zhangsan@example.com', '台北市信義區松山路123號'),
(2, 'S1000000002', '李四', 'F', '2001-05-22', 'lisi@example.com', '新北市板橋區中山路456號'),
(3, 'S1000000003', '王五', 'M', '2002-07-10', 'wangwu@example.com', '高雄市苓雅區建國路789號'),
(4, 'S1000000004', '趙六', 'F', '2000-09-30', 'zhaoliu@example.com', '台中市西區民生路321號'),
(5, 'S1000000005', '周七', 'M', '1999-12-05', 'zhouqi@example.com', '台南市東區和平路654號'),
(6, 'S1000000006', '鄭八', 'F', '2001-03-14', 'zhengba@example.com', '基隆市中正區忠孝路987號'),
(7, 'S1000000007', '林九', 'M', '2000-11-25', 'linjiu@example.com', '桃園市蘆竹區中正路123號'),
(8, 'S1000000008', '張十', 'F', '1998-04-18', 'zhangshi@example.com', '新竹市東區光復路456號'),
(9, 'S1000000009', '陳十一', 'M', '2002-08-01', 'chen11@example.com', '彰化縣員林市大同路789號'),
(10, 'S1000000010', '黃十二', 'F', '2001-01-11', 'huang12@example.com', '苗栗縣竹南鎮建國路654號');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `userpass` varchar(255) NOT NULL,
  `userlevel` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `username`, `userpass`, `userlevel`, `created_at`) VALUES
(1, 'yukia', '$2y$10$WtxhqXT8wIRDcA3/cSn8HOiLbYHm3u1WpzdZgIJN2v9HwjlaFWWzW', 0, '2025-04-28 14:49:45'),
(2, 'yukia1', '$2y$10$6211VPcmxzw2NzEFCoyPU.wFxextBsTOZQ1MLx3Wfdg.gSqzpeM8e', 0, '2025-06-01 22:56:51');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookname` (`bookname`);

--
-- 資料表索引 `cafes`
--
ALTER TABLE `cafes`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schid` (`schid`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cafes`
--
ALTER TABLE `cafes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主鍵', AUTO_INCREMENT=32;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '識別代號', AUTO_INCREMENT=32;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
