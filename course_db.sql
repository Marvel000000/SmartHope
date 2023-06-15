-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:4306:4306
-- Generation Time: Jun 15, 2023 at 05:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `content` text DEFAULT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `tutor_id`, `playlist_id`, `title`, `description`, `content`, `thumb`, `date`, `status`) VALUES
('hHix8NuxDmYuE3LtujV4', 'BigS1y8WFRAaLstwA64X', 'gV3jNdZ94SkAk1IKIWre', 'Unraveling the Power of Algorithms: Shaping the Future', 'In today&#39;s digital age, algorithms have become an integral part of our lives, silently influencing and shaping our daily experiences. From search engine recommendations to personalized social media feeds, algorithms govern countless aspects of our online interactions. This article aims to shed light on algorithms, their significance, and their impact on various domains, highlighting both their benefits and potential challenges.', 'At its core, an algorithm is a set of instructions or rules designed to solve a problem or accomplish a specific task. In the realm of computer science, algorithms are step-by-step procedures that outline the path for solving complex computational problems. Algorithms serve as the backbone of modern technology, empowering machines to perform tasks efficiently and effectively.\r\n\r\nAlgorithms permeate numerous aspects of our daily lives, often operating in the background without our explicit knowledge. Some prominent examples include:\r\nSearch Engines: Algorithms power search engines like Google, utilizing intricate ranking systems to deliver relevant search results based on various factors such as relevance, user preferences, and quality of content.\r\nSocial Media: Platforms like Facebook, Instagram, and Twitter employ algorithms to curate personalized feeds, showing users content they are most likely to engage with, based on their previous interactions, interests, and demographic information.\r\nOnline Shopping: E-commerce giants such as Amazon leverage algorithms to offer personalized product recommendations, based on user browsing history, purchase patterns, and similarities with other users.\r\nFinancial Services: Algorithmic trading plays a pivotal role in the stock market, where complex algorithms analyze vast amounts of data to make lightning-fast trading decisions.\r\n\r\nWhile algorithms offer immense potential, they also raise significant challenges and ethical considerations:\r\nBias and Discrimination: Algorithms can inadvertently perpetuate existing biases present in training data, leading to discriminatory outcomes, such as biased hiring practices or unfair treatment based on demographic factors.\r\nLack of Transparency: Many algorithms operate as &#34;black boxes,&#34; making it difficult to understand their decision-making process and identify potential biases or errors, which can undermine trust and accountability.\r\nPrivacy Concerns: The extensive collection and analysis of user data to power algorithms raise concerns about data privacy, protection, and potential misuse of personal information.\r\nFilter Bubbles and Echo Chambers: Algorithmic curation of content can lead to the creation of filter bubbles, where users are exposed only to information that aligns with their existing beliefs, reinforcing biases and limiting exposure to diverse perspectives.\r\n\r\nConclusion\r\nAlgorithms have emerged as a driving force behind technological advancements, transforming industries, and shaping our digital experiences. While algorithms offer remarkable benefits in terms of efficiency, personalization, and decision-making, it is essential to address the challenges they present, such as bias, transparency, and privacy, to ensure they are used responsibly and ethically. By fostering transparency, accountability, and ongoing discussions, we can harness the power of algorithms to create', 'vZbixVJjLvn7XeiBtZkY.webp', '2023-06-07', 'active'),
('qwcs3SNhpVPG6uCeGtF0', 'BigS1y8WFRAaLstwA64X', 'gV3jNdZ94SkAk1IKIWre', 'The Rise of Algorithmic Decision-Making: Navigating Opportunities and Concerns', 'In an increasingly data-driven world, algorithms have become indispensable tools for making complex decisions efficiently and accurately. This article explores the rise of algorithmic decision-making, highlighting its potential benefits and addressing the concerns surrounding its use. As algorithms continue to shape various aspects of our lives, understanding their capabilities and limitations becomes crucial.', 'Algorithmic decision-making offers tremendous potential to revolutionize industries and improve decision-making processes. By harnessing their power responsibly and addressing concerns related to bias, transparency, and ethical considerations, we can navigate the evolving landscape of algorithmic decision-making. Striking a balance between automation and human judgment is key to reaping the benefits of algorithms while upholding values of fairness, accountability, and societal well-being.', 'jT1IpaLiTOKNIM20WY5C.webp', '2023-06-07', 'active'),
('9FXpsuXxVmEWlLjJZFOZ', '99039XsFSyD5QTf4OTxR', 'e3S3pWXoN26Uby69pTSU', 'The Evolution of Football', 'Football, the beautiful game, has transcended boundaries and captivated the hearts of billions around the world. Throughout its rich history, football has grown from humble beginnings into a global phenomenon that unites people from all walks of life. This article delves into the fascinating evolution of football, exploring its origins, major milestones, and the transformative impact it has had on societies worldwide.', 'Football&#39;s journey from its humble beginnings to its current global stature is a testament to its enduring appeal. The sport&#39;s ability to inspire passion, bridge divides, and bring joy to millions remains unparalleled. As football moves forward, it will continue to captivate hearts and minds, perpetuating its legacy as the world&#39;s most beloved game.', 'EeeBnW8gxxAhcTLbmGJW.jpg', '2023-06-07', 'active'),
('YboxKtnZoPfXN9DE629J', 'Dv25oFU21kYrJU1wX9C5', 'hxhqF8xIGniqnGadrq1R', 'intro', 'intro', 'halo nama saya marvel', '5UCl7TlstwuqLbFuD1hQ.webp', '2023-06-08', 'active'),
('fJrk3SoqeV70LfCNu8v5', 'vgGEcHjrf8KFWScEPxQy', 'eECNWA6DxKmgjy2Rdu0u', 'Hai', 'Heeloo', 'This is the content', 'kxWIkLTc9Wp2rh70w2Lo.png', '2023-06-09', 'active'),
('ay6JgP4YPOBclBnAf4vM', 'F8tEjhApAxowwAL7pGvr', 'SvRoIrkD46raXrqG6SoN', 'The Power of Graphic Design: Enhancing Communication and Captivating Audiences', 'Graphic Design introduction', 'Introduction:\r\n\r\nIn today&#39;s visually-driven world, graphic design has become an integral part of our lives. From the moment we wake up and browse through our smartphones to the billboards we pass on our way to work, design graphics surround us and shape our perceptions. This article explores the transformative power of graphic design, its essential role in effective communication, and how it captivates audiences across various mediums.\r\n\r\nThe Art of Visual Storytelling:\r\nAt its core, graphic design is a form of visual storytelling. It combines creativity, typography, imagery, and layout techniques to convey a message or evoke a specific emotion. Designers use their artistic skills to translate complex ideas and concepts into visually engaging compositions. Whether it&#39;s a logo, packaging, or a website, the aim is to create a compelling narrative that resonates with the target audience.\r\n\r\nEstablishing Brand Identity:\r\nIn the business world, graphic design plays a crucial role in establishing and maintaining a brand&#39;s identity. The logo, color palette, typography, and overall visual aesthetics are meticulously designed to reflect a company&#39;s values, personality, and unique selling proposition. Consistency in design elements across various platforms and materials helps build brand recognition and loyalty among consumers.\r\n\r\nEffective Communication:\r\nGraphic design is a powerful tool for effective communication. It enables designers to simplify complex information and present it in a visually digestible manner. Infographics, charts, and diagrams are excellent examples of how design graphics can distill complex data into easily understandable visuals. By incorporating the right combination of color, typography, and imagery, designers can guide the viewer&#39;s attention and enhance the overall message.\r\n\r\nEngaging Digital Experiences:\r\nWith the rise of the digital age, graphic design has evolved to meet the demands of online platforms. Websites, social media posts, and mobile applications rely heavily on design graphics to create engaging user experiences. User interface (UI) and user experience (UX) design play a pivotal role in ensuring seamless navigation and visually appealing interfaces. Thoughtful graphic design elements enhance interactivity, increase usability, and keep users coming back for more.\r\n\r\nInfluence on Marketing and Advertising:\r\nGraphic design is a cornerstone of marketing and advertising campaigns. Eye-catching visuals and compelling graphics are essential for grabbing attention in a crowded marketplace. Whether it&#39;s a print ad, a billboard, or a social media post, well-executed design graphics can evoke emotions, convey messages, and persuade consumers to take action. Effective design elements such as color psychology, typography choices, and composition techniques contribute to successful marketing campaigns.\r\n\r\nConclusion:\r\n\r\nGraphic design is a dynamic and ever-evolving field that has a profound impact on the way we perceive and interact with the world. From the smallest detail in a logo to the grandeur of a billboard, design graphics shape our experiences and influence our decisions. The ability to tell stories, establish brand identities, communicate effectively, create engaging digital experiences, and drive marketing efforts makes graphic design an indispensable tool in today&#39;s visually-driven society. As technology advances and new mediums emerge, the role of graphic design will continue to evolve, captivating audiences and shaping the way we connect with information and ideas.', '0hkxKtSRY1cN2ui68M5s.jfif', '2023-06-10', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `user_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`user_id`, `playlist_id`) VALUES
('F8tEjhApAxowwAL7pGvr', 'SvRoIrkD46raXrqG6SoN');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` varchar(20) NOT NULL,
  `content_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content_id`, `user_id`, `tutor_id`, `comment`, `date`) VALUES
('snAmLUg3EGTkvQEcFeff', 'Wo1PdJxYBypPMxHjbv97', 'F8tEjhApAxowwAL7pGvr', 'F8tEjhApAxowwAL7pGvr', 'tesrt', '2023-06-15');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` int(10) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `video` varchar(100) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `tutor_id`, `playlist_id`, `title`, `description`, `video`, `thumb`, `date`, `status`) VALUES
('tJxZGxufV1YmppjDvYR3', 'BigS1y8WFRAaLstwA64X', 'gV3jNdZ94SkAk1IKIWre', 'Introduction to Algorithm', 'Introduction to course', 'GzMzdlvKCwkujZb4Lv0x.mp4', 'J92ib5blnn9lClTK5lCn.webp', '2023-06-07', 'active'),
('wJlCVfITvQiBEQZRGeQI', 'Dv25oFU21kYrJU1wX9C5', 'hxhqF8xIGniqnGadrq1R', 'oh caroline', 'Being Funny In a Foreign Language', 'WCi8S9n1O9BmQsG5H9id.mp4', 'y5ZKIrOC599HsckOyMbp.jpeg', '2023-06-07', 'active'),
('oDCoP5ry653K7dizB3ET', '99039XsFSyD5QTf4OTxR', 'e3S3pWXoN26Uby69pTSU', 'power shot', 'how to power shot', 'dLgV4RPyNsaggwiSYL4S.mp4', 'oFQSObSSQaagHSvk6V4Z.jpg', '2023-06-07', 'active'),
('erI10JUpYWeDwNvKPfhB', 'BigS1y8WFRAaLstwA64X', 'gV3jNdZ94SkAk1IKIWre', 'Priori Analysis and Posteriori Testing', 'Difference between Priori Analysis and Posteriori Testing', 'cvw2FRYfdPlTKhvk9ucP.mp4', 'orkrj3ml4EN7Bwe20hO0.webp', '2023-06-08', 'active'),
('dYMWtAaHVhNqgcOPoAFn', 'Dv25oFU21kYrJU1wX9C5', 'hxhqF8xIGniqnGadrq1R', 'all i need to hear', '1975', 'Ub7R993q0S177obx1MWs.mp4', 'PVOUPokYw1QgCK4j239W.jpeg', '2023-06-08', 'active'),
('G2Y47u8k6o5NHuQQrq4n', 'vgGEcHjrf8KFWScEPxQy', 'eECNWA6DxKmgjy2Rdu0u', 'dwa', 'dwada', 'kCEOLABglORQKZPzsrph.mp4', 'hijp5qGmyHYHDY6mDrFW.png', '2023-06-09', 'active'),
('Wo1PdJxYBypPMxHjbv97', 'F8tEjhApAxowwAL7pGvr', 'SvRoIrkD46raXrqG6SoN', 'How to design like a pro', 'Design like a pro in 15 minutes!!', 'ipBAjPaX8UowMvBCTEEM.mp4', '07Eitq2HpIDnZaxkHnSr.webp', '2023-06-10', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `user_id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `content_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `tutor_id`, `title`, `description`, `thumb`, `date`, `status`) VALUES
('gV3jNdZ94SkAk1IKIWre', 'BigS1y8WFRAaLstwA64X', 'Algorithm', 'In today&#39;s digital age, algorithms have become an integral part of our lives, silently influencing and shaping our daily experiences. From search engine recommendations to personalized social media feeds, algorithms govern countless aspects of our online interactions. This course aims to shed light on algorithms, their significance, and their impact on various domains, highlighting both their benefits and potential challenges.', 'FzyHosLpS5Eu5PfArDpf.jpg', '2023-06-07', 'active'),
('hxhqF8xIGniqnGadrq1R', 'Dv25oFU21kYrJU1wX9C5', 'sodimu', '+-', 'NSuxNjoxjQweG59bQB0R.jpg', '2023-06-07', 'active'),
('e3S3pWXoN26Uby69pTSU', '99039XsFSyD5QTf4OTxR', 'Football', 'best', 'nxnujzCrsjd77kB37zDv.jpg', '2023-06-07', 'active'),
('eECNWA6DxKmgjy2Rdu0u', 'vgGEcHjrf8KFWScEPxQy', 'Music Course', 'How to play guitar', 'DZtzsfUXBurkRGh0fUrM.png', '2023-06-08', 'active'),
('SvRoIrkD46raXrqG6SoN', 'F8tEjhApAxowwAL7pGvr', 'Graphic Design For Beginer', 'easy way to start designing', 'uxUGwmUSuT5cxOqJaYMW.jpg', '2023-06-10', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tutors`
--

CREATE TABLE `tutors` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutors`
--

INSERT INTO `tutors` (`id`, `name`, `profession`, `email`, `password`, `image`) VALUES
('BigS1y8WFRAaLstwA64X', 'Matthew', 'developer', 'testing@testing.com', '$2y$10$/UJbfksYexsvbK0JGg.CCuFTdv5NiIe137Mc18OzgVgWEJMcYONKy', 'OLDjtwouwd0WXkIWFb3x.jpg'),
('Dv25oFU21kYrJU1wX9C5', 'Marvel', 'musician', 'testing2@testing.com', '$2y$10$NOAVGMuPg/IfgVhgGi7yduHZ2o6X4v4rvFemWh4eIyop/Zl5c6nNq', 'AGwn5qa04NaP25xiN4ci.jpg'),
('99039XsFSyD5QTf4OTxR', 'John', 'Student', 'testing3@testing.com', '$2y$10$SYXjgr.hzX0gJn6Q2Y0PxOfeVuInmQyuLrzXlF98HMIRPfb1HpnUS', '4J3iU8mY4Y7mrxRbjE5z.jpg'),
('vgGEcHjrf8KFWScEPxQy', 'Budi Setiawan', 'desginer', 'Budi@gmail.com', '$2y$10$DYa8dbLtfi.PJK4uNe82t.K0j1tFaTy.lIJtDPhiuU6EOsOBy1wF.', 'b43mrlNmE4zFNg4xGam8.png'),
('F8tEjhApAxowwAL7pGvr', 'Rudi Gunawan Tampan sekali', 'desginer', 'rudi@gmail.com', '$2y$10$nfnzRH8tw7b8.xdFJ8KDcu5CjjZysLh0Auq3O7KJtxmkcVvtodw0m', '3gq85GQorXlrRTgQGnMx.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
