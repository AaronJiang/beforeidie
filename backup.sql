-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- 主机: Mysql1001.webweb.com
-- 生成日期: 2012 年 12 月 26 日 15:51
-- 服务器版本: 5.5.28
-- PHP 版本: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `db_98db92_w301_1`
--

-- --------------------------------------------------------

--
-- 表的结构 `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `CommentID` int(11) NOT NULL AUTO_INCREMENT,
  `Comment` text NOT NULL,
  `PosterID` int(11) NOT NULL,
  `GoalID` int(11) NOT NULL,
  `ParentCommentID` int(11) NOT NULL,
  `IsRoot` tinyint(1) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CommentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `followers`
--

CREATE TABLE IF NOT EXISTS `followers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FollowerID` int(11) NOT NULL,
  `FolloweeID` int(11) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `followers`
--

INSERT INTO `followers` (`ID`, `FollowerID`, `FolloweeID`, `Time`) VALUES
(4, 24, 0, '2012-12-21 15:14:54'),
(5, 24, 0, '2012-12-21 15:59:07');

-- --------------------------------------------------------

--
-- 表的结构 `goals`
--

CREATE TABLE IF NOT EXISTS `goals` (
  `GoalID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Content` text NOT NULL,
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UserID` int(11) NOT NULL,
  `IsPublic` int(11) NOT NULL,
  PRIMARY KEY (`GoalID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=83 ;

--
-- 转存表中的数据 `goals`
--

INSERT INTO `goals` (`GoalID`, `Title`, `Content`, `CreateTime`, `UserID`, `IsPublic`) VALUES
(9, ' 保持健康', '<div>健康是靠良好的生活习惯保证嘀！</div><div>早上一定要过早，随便吃，特别是杂粮粥很不错。</div><div>早上起床一杯水，然后一天喝足8杯水。<br></div><div><div>保持步行，不要骑自行车。</div><div>中午保持午休！</div><div>一日三餐进餐规律，午吃饱，晚吃少（吃面/打一个菜/吃酱肉包）。</div><div>每天吃一个水果。（没有坚持啊！！！）</div><div>晚上回来就少吃东西，然后做下仰卧起坐，喝一点养生的东西。</div></div>', '2012-07-14 02:41:26', 0, 1),
(10, '做有意义的软件', '<div>做真正有意义、真正能够帮助到他人的软件。在精，不在多！</div><div><b>transy</b></div><div>Chrome插件，中英对照翻译辅助工具。已上线。</div><div>抽时间进行重构，使用一种前端MVC框架（比如blackbone.js）实现。</div><div><b>woxiang</b></div><div>记录并分享每个人发自内心想要的东西、想达到的目标、想实现的梦想。</div><div>开发中，专注于最核心的功能，争取早日上线！</div><div><b>classic</b></div><div>让所有人都能方便地欣赏到中国传统的诗/词/文（当然要精心挑选一些比较适于现代人阅读的材料，并以恰当的方式呈现出来）。我觉得无论有无清晰的盈利模式，这个项目总是蛮有意义的，现代人需要古代文学的滋养！</div><div>原型开发中。</div>', '2012-07-16 07:53:29', 0, 1),
(48, '转型互联网', '<div>3年之后，应聘互联网公司。<br></div><div>一份工作不仅应该看其前景、其报酬，更应该看它的过程你是否喜欢，它在社会中所起的作用是否符合你的价值观。</div><div>You''v got to find what you love，我将追随我心，坚持自己的选择，无论它的代价是什么。是浪费了本科四年的光电知识？还是浪费了研究生3年的嵌入式积累？Just don''t care！</div><div>我将在下面几个方面开始准备：</div><div><b>学科基础</b>：算法和数据结构、操作系统知识、数据库；</div><div><b>Web开发技能</b>：Linux环境熟练使用（开发环境的搭建、服务器的部署与维护）、Vim编辑器、Git源代码管理、流行MVC框架的熟悉（CI/CakePHP等，不仅要使用，而且要看源代码）、学习Python（以及框架Flask）；</div><div><b>线上作品</b>：开发并维护数个我自己乐于使用并对他人有帮助的作品，上线，并将代码的commit过程淋漓尽致地展现在Github上！</div><div><b>社区</b>：个人博客（尚未开动...）、社区互动（GuruDigger、V2EX）；</div><div><b>数学</b>：看完《数学之美》，学习Web智能算法。</div><div>3年之后，我希望能够加入真正尊重工程师的大型互联网公司，或者具有发展潜力的靠谱小公司。但是我最终的归宿，应该不是大公司，大公司有其固有的缺点无法克服，它只是一个跳板吧！</div><div>不积小流，无以成江河；不积跬步，无以至千里。</div><div>坚持下去。</div>', '2012-09-06 12:20:53', 0, 1),
(58, ' 愿得一人心', '<div>一定要和我爱的并且爱我的人一起生活，一定。<br></div><div>愿得一人心，白首不相离。<br></div><div>在对的时间，遇到互相都有好感的人，真的是非常的不容易。而且我相信，如果双方都有好感的话，如果是对的人的话，根本不需要单方面的苦苦追求而不得。</div><div>但换句话说回来，有些感情是你在深入接触之后才能产生的，所以上面一条有时候并不成立！</div><div>如果真的能找到《浮生六记》中的芸娘一般的女子，此生无憾！传统的那种夫妻感情，应该受到现代社会的珍视。</div><div>喜欢这种很朴素、很清秀、很单纯的女孩子，比那种穿得乌烟瘴气、挂一副不可一世的表情的所谓“女神”好多了！</div><div>薛玉感觉还是没长大的样子哈！怎么样才能打破她对我的隔阂感？我需要坚持吧！没有追不到的妹子，我一定要记住这一点！</div><div>现在我又有点泄气的感觉了啊！真的是对我完全没有反应的啊？</div><div>今天看了一篇文章：既然已经确定，那就一路走到黑！虽然现在薛玉表现出来确实对我没意思，而且和我内心中的完美女孩有些差距，但是以后可以磨合啊！想一想精卫填海，我他妈豁出去了，男人怕什么丢面子？我擦！！！！</div>', '2012-11-10 11:24:31', 0, 0),
(61, '安静地生活', '<div>在安静中生活，在安静中学习，在安静中看世界。</div><div>每天保持一刻钟的安静时间，不需要说话，不需要胡思乱想，就是静静地活着。</div>', '2012-12-01 03:17:10', 0, 1),
(73, ' 做饭', '<div>去菜场和大妈大爷侃价买菜，回来慢慢地准备食材，一道菜一道菜地做，然后和心爱的姑娘一起分享，这是一种最接地气的生活了吧？</div><div>我想至少学会：下面、炒饭、打汤，这是最基本的了。</div><div>但是呢，好像确实没神马机会哈，我想或许只有等到工作以后，真正单独住宿的时候，才能安下心来学做饭吧？</div><div>不开心的时候就做饭！食疗！</div>', '2012-12-09 15:33:43', 0, 1),
(75, ' 职业理想', '<div>今天看到了博客园转载的一篇文章《互联网造富亲历者讲述：屌丝富了以后》，感觉互联网的一个阴暗面就是：为了追求纸面财富不择手段，而把真正的价值抛之脑后。这是很危险的，以后我一定要牢记！什么才是真正的价值！</div><div>我的职业理想，一定是要创造真正的价值，真正利用互联网这个工具，去让人们的生活更加美好。一定一定牢记这一点！</div>', '2012-12-15 05:01:30', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `GoalID` int(11) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- 表的结构 `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `MessageID` int(11) NOT NULL AUTO_INCREMENT,
  `Message` text NOT NULL,
  `PosterID` int(11) NOT NULL,
  `ReceiverID` int(11) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`MessageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `AvatarUrl` varchar(100) NOT NULL,
  `IsActive` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `AvatarUrl`, `IsActive`) VALUES
(0, 'hustlzp', '08d6acce24512841e8904f8b995eb32890fa52ed', 'hustlzp@qq.com', 'http://www.gravatar.com/avatar/a4ae9ee239aa66109e7a44e2edb2d757', 1),
(3, 'T.W.U', 'dc3e43c5ac363397bb905f13e702ee5c59e41c53', '757111858@qq.com', 'http://www.gravatar.com/avatar/edc3260de36d4744c695f6196e26718f', 1),
(4, 'yanyojun', 'ace71260b21738ab729d2a019276667a8d3993da', 'yanyojun@foxmail.com', 'http://www.gravatar.com/avatar/ab73e9e3782a2b208389bb19f0754cf4', 1),
(5, 'daniel', '31fb2daafbf44436f0f69cf892ca99cb94d9c6e3', '651309577@qq.com', 'http://www.gravatar.com/avatar/7a2efe6a1b5de500345626b324262a5c', 1),
(6, 'Frost', '51370826fe3c9c1ee5df59ee3c7162d2c22c1062', 'xiaokangfrost@qq.com', 'http://www.gravatar.com/avatar/9764da19e9e69b8fd2d579099da2b72d', 1),
(7, '雪地里DE星星沙', '01a3b7393be6bc1277a46568f0cc2524ed946061', '1351222519@qq.com', 'http://www.gravatar.com/avatar/4f557aab8db05fc1df70252281318725', 1),
(8, 'An逝颜&倾城', 'd31fdf09fccf7a625690e853fa49575544b44d8e', 'panzaiyu@vip.qq.com', 'http://www.gravatar.com/avatar/626d87ae041a4855cd3a8de22c61cf1d', 1),
(9, 'justbliv', '96bb10189e61ef47e6b93e5faa143ec03da36bbb', 'justbliv@163.com', 'http://www.gravatar.com/avatar/204441ecc49bf9d6fde765c3f32ee375', 1),
(10, '小北kevin', '56b7134548b78fdf0b21ace1b2cbf50bcd4b823d', 'chenyuxiaodhr@gmail.com', 'http://www.gravatar.com/avatar/c41dcf932776c21f2dc2330728211a1f', 1),
(11, '胸肌夹死蚂蚁', '64f7741b6b9b91666e9d2ee8e3e7ba11df9877c9', 'hufei68@gmail.com', 'http://www.gravatar.com/avatar/b891e81ab838d1b76c8e17bb3087cbf1', 1),
(12, '不舍睡', 'eb1ecb903aee4f7d6411b83eef0ad6bf6b4b804a', '1192670004@qq.com', 'http://www.gravatar.com/avatar/c63d40222c3d6c4b7ee6955f9665f1fa', 1),
(13, 'chairmanhou', '2a569dfce66ac87a3af3d1004c6fa614668664f0', 'chairmanhou@qq.com', 'http://www.gravatar.com/avatar/d81ab7612d6b346f30457bb4ca3bbcdc', 1),
(14, 'AIchipmunk', '890a0e62424e188bc863e927eb050336674a0047', 'jerryanix@gmail.com', 'http://www.gravatar.com/avatar/f352280d16bd1f3fe51a8ff37f021a54', 1),
(15, '学弟', '2fcbd4e3501db943b055227840b2ae9b80f68a4a', '378874086@qq.com', 'http://www.gravatar.com/avatar/1e1a0362586f7ba30607d4f9fdb83879', 1),
(16, 'D丶R雨', 'ea49b8cc5268bb0c0df8215504a9fee282dfb829', '404807356@qq.com', 'http://www.gravatar.com/avatar/bff3e029a71f9337803fd5d6d8bb5ba6', 1),
(17, 'xingzhewujiang', '4f19fc5178e854e073a022401f53dc454dc2a7ec', '812803413@qq.com', 'http://www.gravatar.com/avatar/3110d41de2061480fa959ec814a866a9', 1),
(18, 'xy', '9f87300428a6a10145ff33fbc7010380da550055', 'shineeblue@sina.cn', 'http://www.gravatar.com/avatar/6d447afd9c48b47ee1676cb28e3cc6bf', 1),
(19, 'kamehamehon', '7ab515d12bd2cf431745511ac4ee13fed15ab578', 'jin.cai20@gmail.com', 'http://www.gravatar.com/avatar/27f0e0417bcb011604eca1c197e8b3d8', 1),
(20, 'halida', '50a7b2d9f8f47c0656444e7704dddade279a92c0', 'linjunhalida@gmail.com', 'http://www.gravatar.com/avatar/946dbc66d19ba815ffec20d05f138f73', 1),
(21, '王子凯', 'b9ca002b258285306f7a6f18be8b6e6f6ea55fa3', 'byrdkm17@gmail.com', 'http://www.gravatar.com/avatar/7c3882085429b44adc5ac6327e889c12', 1),
(22, 'jinlq868', '40d94a7a473e887ca8d162479163f4c101a18249', 'qyw868@sina.com', 'http://www.gravatar.com/avatar/00998ca0c45f9e96a0c6bb61f5002f63', 1),
(23, 'goaler', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'qatest2@163.com', 'http://www.gravatar.com/avatar/1061e317024510633efc833fa07e75bd', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
