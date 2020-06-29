CREATE DATABASE IF NOT EXISTS `tables_db`;

use `tables_db`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `user`, `password`) VALUES
(1, '0424935d878bbae542183e534abe55cc565f543763eb8a567eeaf4de3b408a8c', '6c69472db415abe6fa9b139291da14816682f2c72ca47c62e4ee222283537c18'),
(45, '4ad7ad23e8cb5166febb614f338a959413bb8464ab2d9811afcc7995bb1c75b6', '6c69472db415abe6fa9b139291da14816682f2c72ca47c62e4ee222283537c18'),
(47, '075fa4d61b9765a2cacc5cb5d46ff5ee7ecbd7599932ad434d239d54f3bda61f', '6c69472db415abe6fa9b139291da14816682f2c72ca47c62e4ee222283537c18'),
(48, 'ba5f91dc7b99da93a8ee750fd83701a9a80d6117031a6b3abbe97b91d3f6af4f', '6c69472db415abe6fa9b139291da14816682f2c72ca47c62e4ee222283537c18');

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

--user = "root" , pass = "1234"
