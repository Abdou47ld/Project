-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 23 avr. 2024 à 20:42
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gaming3`
--

-- --------------------------------------------------------

--
-- Structure de la table `cards`
--

CREATE TABLE `cards` (
  `card_id` int(255) NOT NULL,
  `cardholderName` text NOT NULL,
  `cardNumber` text NOT NULL,
  `expirationDate` text NOT NULL,
  `cvv` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cards`
--

INSERT INTO `cards` (`card_id`, `cardholderName`, `cardNumber`, `expirationDate`, `cvv`) VALUES
(10, 'dialomohammed', '5142394784212345', '12/23', 566),
(11, 'dialomohammed', '3737279436742943', '11/24', 344),
(12, 'dialomohammed', '1234567891121233', '12/23', 233);

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(255) NOT NULL,
  `produit_id` int(255) NOT NULL,
  `nom_produit` text NOT NULL,
  `image_produit` text NOT NULL,
  `prix_produit` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `prix_total` int(255) NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `commande_id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `adress` text NOT NULL,
  `codepostal` text NOT NULL,
  `tel` text NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_total` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `livred` int(11) NOT NULL,
  `commande_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`commande_id`, `nom`, `adress`, `codepostal`, `tel`, `quantite`, `prix_total`, `user_id`, `produit_id`, `livred`, `commande_date`) VALUES
(10, 'dialomohammed', 'montreal teccart ', '24555', '5142496821', 1, 40, 4, 8, 2, '2024-04-18 23:38:06'),
(11, 'dialomohammed', 'montreal teccart ', '24555', '5142496821', 1, 88, 4, 7, 2, '2024-04-18 23:38:06'),
(12, 'dialomohammed', 'montreal teccart ', '24555', '5142496821', 2, 120, 4, 10, 2, '2024-04-22 03:20:33'),
(13, 'dialomohammed', 'montreal teccart ', '24555', '5142496821', 1, 88, 6, 7, 2, '2024-04-22 03:31:07'),
(14, 'dialomohammed', 'montreal teccart ', '24555', '5142496821', 1, 60, 6, 9, 2, '2024-04-22 03:31:07');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom_produit` text NOT NULL,
  `description_produit` text NOT NULL,
  `image_produit` text NOT NULL,
  `prix_produit` int(20) NOT NULL,
  `categorie_produit` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom_produit`, `description_produit`, `image_produit`, `prix_produit`, `categorie_produit`) VALUES
(7, 'Razer Tartarus v2 Gaming Keypad', 'About this item High-Performance Mecha-Membrane Switches: Provides the tactile feedback of mechanical key press on a comfortable, soft-cushioned, membrane, rubber dome switch suitable for gaming 32 Mecha-Membrane Keys for More Hotkeys and Actions: Perfect for gaming or integrating into creative workflows with fully programmable keys. Analog Functionality: No Thumbpad for Improved Movement Controls: The 8-way directional thumbpad allows for more natural controls for console-oriented players and a more ergonomic experience Fully Programmable Macros: Razer Hypershift allows for all keys and keypress combinations to be remapped to execute complex commands Ultimate Personalization & Gaming Immersion with Razer Chroma: Fully syncs with popular games, Razer hardware, Philips Hue, and gear from 30+ partners; supports 16. 8 million colors on individually backlit keys', 'uploads/Razer Tartarus v2 Gaming Keypad.jpg', 88, 'Souris'),
(8, ' HyperMagnetic Gaming Keyboard ', 'About this item INFINITELY CUSTOMIZABLE, UNTETHERED SPEED with OmniPoint 2.0 Adjustable HyperMagnetic switches WORLD’S FASTEST KEYBOARD — 20x faster actuation, 11x faster response than traditional mechanical keyboards RAPID TRIGGER - Eradicate latency arising from the physical movement of the switch through dynamic activation and deactivation of keys based on travel distance rather than a fixed point in the key travel ULTIMATE CONTROL – 40 levels of per-key actuation (0.1 – 4.0mm) – set WASD for light, ultra-fast movements and set ability keys to deep presses to avoid accidentally triggering specials 2-IN-1 ACTION KEYS — Program two different actions to the same key, such as walking with a light touch or sprinting with a deep press Lag-free Quantum 2.0 Dual Wireless with a 2.4GHz connection and Bluetooth 5.0 Esports-ready TKL form factor; Full-size functionality; Premium aluminum top plate; Detachable USB-C', 'uploads/ HyperMagnetic Gaming Keyboard .jpg', 40, 'Clavier'),
(9, 'PS5 controller ', 'About this item Bring gaming worlds to life - Feel your in-game actions and environment simulated through haptic feedback*. Experience varying force and tension at your fingertips with adaptive triggers* Find your voice, share your passion - Chat online through the built-in microphone. Connect a headset directly via the 3.5mm jack. Record and broadcast your epic gaming moments with the create button A gaming icon in your hands - Enjoy a comfortable, evolved design with an iconic layout and enhanced sticks. Hear higher-fidelity** sound effects through the built-in speaker in supported games Multi-device connectivity - Connect using a USB Type-C cable or Bluetooth technology and easily play on more devices including Windows PC and Mac computers. Elevate PC gaming with advanced features like haptic feedback and adaptive triggers in a range of blockbuster PC titles.', 'uploads/PS5 controller .jpg', 60, 'controll'),
(10, 'Redragon M908', 'Professional Gaming Mouse - Redragon M908 optical gaming mouse is designed with up to 12400 DPI, 5 adjustable DPI levels (500/1000/2000/3000/6200 DPI) meet your multiple needs, either for daily work or gaming. DPI can be adjusted freely by ±100 from 100 to 12400 via software. 1000 Hz polling rate, 30G acceleration and high-precision Pixart PAW3327 Sensor giving you a greater edge over your competition. RGB Backlight & Programmable Buttons - 16.8 million RGB LED color options (LED Backlight can be disabled). 18 programmable buttons, 5 memory profiles each with a dedicated light color for quick identification. Comes with 8-piece weight tuning set (2.4g x8), easy to change the weight to suit your games. Comfort & Precision At Your Hands - Redragon M908 gaming mouse is an essential computer accessory for die-hard gamers with its aggressive design for hands! You will be amazed by the unmatched comfort, lethal accuracy and killer precision of our durable, desktop and laptop pro gaming mouse! High-end Design - Redragon M908 Mouse features 8 buttons and 12 MMO programmable side buttons. Durable smooth TEFLON feet pads for ultimate gaming control. 6ft braided-fiber cable with gold-plated USB connector ensures greater durability. Die-hard Gamers Choice - Whether you are targeting, aiming, slashing or attacking, a professional gaming mouse is your basic weapon! The mouse will be your ideal partner. Compatible with Windows 2000/ME/XP/03/VISTA/7/8/10 system for programmable using and Mac OS for normal using.', 'uploads/Redragon M908.jpg', 60, 'Souris'),
(11, 'Redragon K580 VATA RGB', 'About this item √ 5 MACRO KEYS: There are 5 programmable macro keys(G1~G5) on the keyboard which can be recorded macros on the fly without any additional software required to be installed. Easy to edit and DIY your stylish keyboard. 【No CD software included, please download software from http://bit.ly/K580keyboard】 √ DEDICATED MULTIMEDIA CONTROLS. Dedicated media controls let you quickly play, pause, skip the music right from the keyboard without interrupting your game. Also, designed with a volume/backlight adjusting wheel, it\'s easy to adjust volume or backlight brightness directly with the wheel in the upper right side of the keyboard. Very convenient and cool looking. √ Upgraded Hot-Swap: The brand new upgrade with nearly all switches(3/5 pins) compatible, the free-mod hot-swappable socket is available now. The exclusive next-level socket makes the switch mounting easier and more stable than ever. √ RGB BACKLIGHT: 18 backlight models allow you to type in the dark. You can adjust its brightness with a control wheel or FN + Up/Down. 5 modes of RGB side edge lighting. The color of each key lighting on the keyboard can be customized easily without installing software, a great choice to DIY your stylish keyboard. √ Durability: 50 million times keystroke test, small actuation force, and short travel make it. Special Double-shot injection molded keycaps never fade Key color. Waterproof and dust resistant.', 'uploads/Redragon K580 VATA RGB.jpg', 89, 'Clavier');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `telephone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `password`, `telephone`) VALUES
(4, 'MOHAMMED ', 'diallo', 'moahmmeddialo@gmail.com', 'asdfrez123.@', '5142496821'),
(5, '', '', '', '', ''),
(6, 'Amine', 'Daiz', 'aminedaiz@gmail.com', 'qwerty', '514345976');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`card_id`);

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`commande_id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cards`
--
ALTER TABLE `cards`
  MODIFY `card_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `commande_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
