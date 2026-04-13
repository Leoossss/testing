<?php
/**
 * CodeStart - Онлайн-школа программирования
 * Однофайловое PHP-приложение
 */

// === КОНФИГУРАЦИЯ И ДАННЫЕ ===
$courses = [
    'html-css' => [
        'id' => 'html-css',
        'title' => 'HTML & CSS',
        'description' => 'Освой вёрстку сайтов: от базовых тегов до адаптивного дизайна и анимаций',
        'image' => 'https://images.unsplash.com/photo-1547658719-da2b51169166?w=400',
        'duration' => '6 недель',
        'format' => 'Онлайн + записи',
        'price' => '19 900 ₽'
    ],
    'javascript' => [
        'id' => 'javascript',
        'title' => 'JavaScript',
        'description' => 'Научись создавать динамические веб-приложения и работать с API',
        'image' => 'https://images.unsplash.com/photo-1579468118864-1b9ea3c0db4a?w=400',
        'duration' => '10 недель',
        'format' => 'Онлайн + ментор',
        'price' => '34 900 ₽'
    ],
    'python' => [
        'id' => 'python',
        'title' => 'Python',
        'description' => 'Изучи универсальный язык для бэкенда, анализа данных и автоматизации',
        'image' => 'https://images.unsplash.com/photo-1526379095098-d400fd0bf935?w=400',
        'duration' => '8 недель',
        'format' => 'Онлайн + практика',
        'price' => '29 900 ₽'
    ]
];

$reviews = [
    [
        'name' => 'Анна К.',
        'role' => 'выпускница',
        'text' => 'Прошла курс по HTML/CSS с нуля. За 6 недель сверстала 5 проектов и уже беру первые заказы на фрилансе!',
        'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100'
    ],
    [
        'name' => 'Дмитрий В.',
        'role' => 'junior-разработчик',
        'text' => 'JavaScript-курс изменил мою карьеру. Ментор помогал разбирать сложные темы, а проекты в портфолио помогли устроиться в студию.',
        'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100'
    ],
    [
        'name' => 'Мария С.',
        'role' => 'аналитик данных',
        'text' => 'Python изучала для автоматизации задач на работе. Теперь пишу скрипты, которые экономят мне 10 часов в неделю!',
        'avatar' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100'
    ]
];

// === ОБРАБОТКА ФОРМЫ ===
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $course = trim($_POST['course'] ?? '');
    $comment = trim($_POST['message'] ?? '');
    
    // Простая валидация
    $errors = [];
    if (!$name || strlen($name) < 2) $errors[] = 'Введите корректное имя';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Введите корректный email';
    if (!$course) $errors[] = 'Выберите курс';
    
    if ($errors) {
        $message = implode('<br>', $errors);
        $messageType = 'error';
    } else {
        // Здесь могла бы быть отправка письма или сохранение в БД
        // mail($adminEmail, "Новая заявка", "Имя: $name\nEmail: $email\nКурс: $course");
        
        $message = "Спасибо, $name! Ваша заявка на курс принята. Мы свяжемся с вами в ближайшее время.";
        $messageType = 'success';
        
        // Очистка полей после успешной отправки
        $name = $email = $course = $comment = '';
    }
}

// Функция для безопасного вывода
function e($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeStart - Онлайн-школа программирования</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        /* === ОБЩИЕ СТИЛИ === */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Roboto', sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        section { padding: 80px 0; }
        h2 { text-align: center; margin-bottom: 50px; font-size: 32px; color: #1e3a5f; font-weight: 700; font-family: 'Poppins', sans-serif; }
        
        /* === КНОПКИ === */
        .btn { display: inline-block; background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%); color: #fff; padding: 12px 30px; text-decoration: none; border-radius: 8px; transition: all 0.3s; border: none; cursor: pointer; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 15px; }
        .btn:hover { background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%); transform: translateY(-2px); box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4); }
        
        /* === ШАПКА === */
        header { background: #fff; box-shadow: 0 2px 20px rgba(0,0,0,0.08); position: fixed; width: 100%; top: 0; z-index: 100; }
        header .container { display: flex; justify-content: space-between; align-items: center; padding: 18px 20px; }
        .logo a { font-size: 28px; font-weight: 800; color: #2563eb; text-decoration: none; font-family: 'Poppins', sans-serif; }
        .nav-links { display: flex; list-style: none; gap: 28px; }
        .nav-links a { text-decoration: none; color: #374151; transition: color 0.3s; font-weight: 500; }
        .nav-links a:hover { color: #2563eb; }
        
        /* === HERO === */
        .hero { background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%); color: #fff; text-align: center; padding-top: 160px; min-height: 100vh; display: flex; align-items: center; }
        .hero-content h1 { font-size: 48px; margin-bottom: 20px; font-weight: 800; font-family: 'Poppins', sans-serif; line-height: 1.2; }
        .hero-content p { font-size: 20px; margin-bottom: 35px; font-weight: 300; opacity: 0.95; }
        .hero .btn { background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%); color: #1e293b; }
        .hero .btn:hover { background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%); box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4); }
        
        /* === СЛАЙДЕР === */
        .slider-section { background: #f8fafc; padding: 60px 0; }
        .carousel { max-width: 900px; margin: 0 auto; overflow: hidden; border-radius: 16px; box-shadow: 0 10px 40px rgba(30,58,95,0.15); }
        .carousel-slide { position: relative; }
        .carousel-slide input[type="radio"] { display: none; }
        .carousel-inner { display: flex; transition: transform 0.6s ease-in-out; }
        .carousel-item { min-width: 100%; position: relative; }
        .carousel-item img { width: 100%; height: 450px; object-fit: cover; }
        .carousel-caption { position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(30,58,95,0.9), transparent); color: #fff; padding: 40px 30px 30px; }
        .carousel-caption h3 { font-size: 28px; margin-bottom: 10px; font-weight: 700; font-family: 'Poppins', sans-serif; }
        .carousel-caption p { font-size: 16px; opacity: 0.95; }
        .carousel-controls { position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); display: flex; gap: 10px; z-index: 10; }
        .slide-dot { width: 12px; height: 12px; border-radius: 50%; background: rgba(255,255,255,0.5); cursor: pointer; transition: all 0.3s; }
        .slide-dot:hover { background: rgba(255,255,255,0.9); }
        #slide1:checked ~ .carousel-inner { transform: translateX(0); }
        #slide2:checked ~ .carousel-inner { transform: translateX(-100%); }
        #slide3:checked ~ .carousel-inner { transform: translateX(-200%); }
        #slide1:checked ~ .carousel-controls label:nth-child(1), #slide2:checked ~ .carousel-controls label:nth-child(2), #slide3:checked ~ .carousel-controls label:nth-child(3) { background: #3b82f6; width: 30px; border-radius: 6px; }
        
        /* === О ШКОЛЕ === */
        .about-content { display: flex; align-items: center; gap: 50px; flex-wrap: wrap; }
        .about-text { flex: 1; }
        .about-text p { margin-bottom: 15px; font-size: 16px; line-height: 1.8; }
        .about-image { flex: 1; }
        .about-image img { width: 100%; border-radius: 12px; box-shadow: 0 10px 30px rgba(30,58,95,0.15); }
        
        /* === КУРСЫ === */
        .services { background: #f1f5f9; }
        .services-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; }
        .service-card { background: #fff; padding: 30px; border-radius: 16px; text-align: center; box-shadow: 0 5px 25px rgba(30,58,95,0.08); transition: all 0.3s; overflow: hidden; }
        .service-card:hover { transform: translateY(-10px); box-shadow: 0 20px 50px rgba(30,58,95,0.15); }
        .service-card img { width: 100%; height: 200px; object-fit: cover; border-radius: 10px; margin-bottom: 20px; }
        .service-card h3 { margin-bottom: 15px; color: #2563eb; font-size: 22px; font-weight: 700; font-family: 'Poppins', sans-serif; }
        .service-card p { color: #64748b; margin-bottom: 20px; }
        .tour-info { background: #f8fafc; padding: 15px; border-radius: 10px; margin-bottom: 20px; border-left: 3px solid #3b82f6; text-align: left; }
        .tour-detail { display: flex; justify-content: space-between; margin-bottom: 8px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0; }
        .tour-detail:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
        .tour-detail .label { color: #64748b; font-weight: 500; }
        .tour-detail .value { color: #1e3a5f; font-weight: 700; font-size: 15px; }
        
        /* === ПРЕИМУЩЕСТВА === */
        .features { background: #fff; }
        
        /* === ОТЗЫВЫ === */
        .reviews { background: #f8fafc; }
        .review-card { background: #fff; padding: 25px; border-radius: 16px; box-shadow: 0 5px 20px rgba(30,58,95,0.08); display: flex; gap: 20px; text-align: left; transition: transform 0.3s; }
        .review-card:hover { transform: translateY(-5px); }
        .review-avatar img { width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 3px solid #3b82f6; }
        .review-content { flex: 1; }
        .review-text { color: #475569; font-size: 15px; line-height: 1.7; margin-bottom: 12px; font-style: italic; }
        .review-author { color: #1e3a5f; font-weight: 600; font-family: 'Poppins', sans-serif; font-size: 14px; }
        .review-author span { color: #3b82f6; font-weight: 400; }
        
        /* === ФОРМА === */
        .contact-form { max-width: 600px; margin: 0 auto; background: #fff; padding: 40px; border-radius: 16px; box-shadow: 0 10px 40px rgba(30,58,95,0.1); }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #1e3a5f; font-family: 'Poppins', sans-serif; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 10px; font-family: 'Roboto', sans-serif; font-size: 15px; transition: border-color 0.3s, box-shadow 0.3s; background: #fff; }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.15); }
        .form-group select { cursor: pointer; appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; padding-right: 35px; }
        .contact-form .btn { width: 100%; cursor: pointer; font-size: 16px; padding: 14px; }
        
        /* === СООБЩЕНИЯ === */
        .alert { padding: 15px 20px; border-radius: 10px; margin-bottom: 25px; font-weight: 500; }
        .alert.success { background: #dcfce7; color: #166534; border: 1px solid #86efac; }
        .alert.error { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
        
        /* === ФУТЕР === */
        footer { background: linear-gradient(135deg, #1e3a5f 0%, #0f172a 100%); color: #fff; text-align: center; padding: 40px 0; }
        .social-links { margin-top: 20px; }
        .social-links a { color: #fff; text-decoration: none; margin: 0 15px; transition: color 0.3s; font-weight: 500; }
        .social-links a:hover { color: #60a5fa; }
        
        /* === АДАПТИВНОСТЬ === */
        @media (max-width: 768px) {
            .hero-content h1 { font-size: 32px; }
            .hero-content p { font-size: 16px; }
            .about-content { flex-direction: column; text-align: center; }
            .nav-links { gap: 15px; font-size: 14px; }
            .services-grid { grid-template-columns: 1fr; }
            section { padding: 50px 0; }
            .carousel-item img { height: 300px; }
            .carousel-caption h3 { font-size: 22px; }
            .review-card { flex-direction: column; text-align: center; }
            .review-avatar { margin: 0 auto; }
        }
        @media (max-width: 480px) {
            header .container { flex-direction: column; gap: 12px; }
            .nav-links { flex-wrap: wrap; justify-content: center; }
            .contact-form { padding: 25px; }
            .logo a { font-size: 24px; }
            .carousel-controls { bottom: 15px; }
        }
    </style>
</head>
<body>

    <!-- Шапка -->
    <header>
        <div class="container">
            <div class="logo"><a href="#home">CodeStart</a></div>
            <nav>
                <ul class="nav-links">
                    <li><a href="#home">Главная</a></li>
                    <li><a href="#about">О школе</a></li>
                    <li><a href="#courses">Курсы</a></li>
                    <li><a href="#reviews">Отзывы</a></li>
                    <li><a href="#contact">Контакты</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <h1>Стань программистом с нуля вместе с CodeStart</h1>
                <p>Практические курсы по веб-разработке, программированию и карьере в IT</p>
                <a href="#courses" class="btn">Выбрать курс</a>
            </div>
        </div>
    </section>

    <!-- Слайдер -->
    <section class="slider-section">
        <div class="container">
            <h2>Популярные направления</h2>
            <div class="carousel">
                <div class="carousel-slide">
                    <input type="radio" name="slider" id="slide1" checked>
                    <input type="radio" name="slider" id="slide2">
                    <input type="radio" name="slider" id="slide3">
                    <div class="carousel-controls">
                        <label for="slide1" class="slide-dot"></label>
                        <label for="slide2" class="slide-dot"></label>
                        <label for="slide3" class="slide-dot"></label>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item">
                            <img src="https://images.unsplash.com/photo-1547658719-da2b51169166?w=800" alt="HTML/CSS">
                            <div class="carousel-caption"><h3>HTML & CSS</h3><p>Создавай красивые и адаптивные сайты с нуля</p></div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://images.unsplash.com/photo-1579468118864-1b9ea3c0db4a?w=800" alt="JavaScript">
                            <div class="carousel-caption"><h3>JavaScript</h3><p>Интерактивные веб-приложения и фронтенд</p></div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://images.unsplash.com/photo-1526379095098-d400fd0bf935?w=800" alt="Python">
                            <div class="carousel-caption"><h3>Python</h3><p>Бэкенд, анализ данных и автоматизация</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- О школе -->
    <section class="about" id="about">
        <div class="container">
            <h2>О школе</h2>
            <div class="about-content">
                <div class="about-text">
                    <p>Добро пожаловать в <strong>CodeStart</strong> — онлайн-школу программирования, где мы помогаем новичкам войти в мир IT.</p>
                    <p>Наша методика: 80% практики, 20% теории. Каждое занятие с домашними заданиями и проверкой от ментора.</p>
                    <p><strong>Наши курсы:</strong> HTML/CSS, JavaScript, Python</p>
                    <p>После обучения — сертификат и помощь в трудоустройстве.</p>
                </div>
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=600" alt="Студенты">
                </div>
            </div>
        </div>
    </section>

    <!-- Курсы -->
    <section class="services" id="courses">
        <div class="container">
            <h2>Наши курсы</h2>
            <div class="services-grid">
                <?php foreach ($courses as $course): ?>
                <div class="service-card">
                    <img src="<?= e($course['image']) ?>" alt="<?= e($course['title']) ?>">
                    <h3><?= e($course['title']) ?></h3>
                    <p><?= e($course['description']) ?></p>
                    <div class="tour-info">
                        <div class="tour-detail"><span class="label">Длительность:</span><span class="value"><?= e($course['duration']) ?></span></div>
                        <div class="tour-detail"><span class="label">Формат:</span><span class="value"><?= e($course['format']) ?></span></div>
                        <div class="tour-detail"><span class="label">Стоимость:</span><span class="value">от <?= e($course['price']) ?></span></div>
                    </div>
                    <a href="#contact" class="btn" onclick="document.getElementById('course').value='<?= e($course['id']) ?>'">Записаться</a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Преимущества -->
    <section class="features">
        <div class="container">
            <h2>Почему выбирают нас</h2>
            <div class="services-grid">
                <div class="service-card">
                    <h3>Индивидуальный подход</h3>
                    <p>Персональный ментор и обратная связь по каждому заданию</p>
                </div>
                <div class="service-card">
                    <h3>Практика с первого урока</h3>
                    <p>Реальные проекты для портфолио вместо сухой теории</p>
                </div>
                <div class="service-card">
                    <h3>Поддержка 24/7</h3>
                    <p>Чат с преподавателями и комьюнити студентов в любое время</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Отзывы -->
    <section class="reviews" id="reviews">
        <div class="container">
            <h2>Отзывы студентов</h2>
            <div class="services-grid">
                <?php foreach ($reviews as $review): ?>
                <div class="review-card">
                    <div class="review-avatar"><img src="<?= e($review['avatar']) ?>" alt="<?= e($review['name']) ?>"></div>
                    <div class="review-content">
                        <p class="review-text">«<?= e($review['text']) ?>»</p>
                        <p class="review-author">— <?= e($review['name']) ?>, <span><?= e($review['role']) ?></span></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Форма -->
    <section class="contact" id="contact">
        <div class="container">
            <h2>Записаться на курс</h2>
            
            <?php if ($message): ?>
                <div class="alert <?= $messageType ?>">
                    <?= $message ?>
                </div>
            <?php endif; ?>
            
            <form class="contact-form" method="POST" action="#contact">
                <div class="form-group">
                    <label for="name">Ваше имя</label>
                    <input type="text" id="name" name="name" placeholder="Введите имя" required value="<?= e($_POST['name'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="your@email.com" required value="<?= e($_POST['email'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label for="course">Выберите курс</label>
                    <select id="course" name="course" required>
                        <option value="">-- Выберите курс --</option>
                        <?php foreach ($courses as $id => $c): ?>
                            <option value="<?= e($id) ?>" <?= (($_POST['course'] ?? '') === $id) ? 'selected' : '' ?>>
                                <?= e($c['title']) ?> — <?= e($c['price']) ?>
                            </option>
                        <?php endforeach; ?>
                        <option value="consultation">Бесплатная консультация</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="message">Ваш вопрос или комментарий</label>
                    <textarea id="message" name="message" rows="4" placeholder="Расскажите о вашем опыте и целях..."><?= e($_POST['message'] ?? '') ?></textarea>
                </div>
                <button type="submit" class="btn">Отправить заявку</button>
            </form>
        </div>
    </section>

    <!-- Футер -->
    <footer>
        <div class="container">
            <p>&copy; <?= date('Y') ?> CodeStart. Все права защищены.</p>
            <div class="social-links">
                <a href="#">Telegram</a>
                <a href="#">VK</a>
                <a href="#">YouTube</a>
            </div>
        </div>
    </footer>

</body>
</html>
