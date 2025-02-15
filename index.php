<?php
session_start();
if(!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Viewer - Dashboard</title>
    <style>
        /* Header and Common Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #1a1a1a;
            color: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        .header {
            background: #2d2d2d;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #3d3d3d;
        }

        .website-title {
            color: #2ecc71;
            font-size: 1.8rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logout-btn {
            background: #e74c3c;
            color: white;
            padding: 8px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .logout-btn:hover {
            background: #c0392b;
        }

        /* Main Content Styles */
        .container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .section-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .add-section-btn {
            background: #2ecc71;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }

        .add-section-btn:hover {
            background: #27ae60;
        }

        /* Video Sections Grid */
        #sectionsContainer {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            padding: 15px;
        }

        @media (max-width: 1200px) {
            #sectionsContainer {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        @media (max-width: 992px) {
            #sectionsContainer {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 576px) {
            #sectionsContainer {
                grid-template-columns: 1fr;
            }
        }

        .section {
            background: #2d2d2d;
            padding: 1.5rem;
            border-radius: 8px;
            position: relative;
        }

        .remove-section-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #e74c3c;
            color: white;
            border: none;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            margin-top: 1rem;
            border-radius: 6px;
            overflow: hidden;
        }

        .video-container iframe {
            position: absolute;
            width: 100%;
            height: 100%;
            border: none;
        }

        .url-input {
            width: 100%;
            padding: 10px;
            background: #1f1f1f;
            border: 2px solid #3d3d3d;
            border-radius: 6px;
            color: #fff;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1 class="website-title">MK Multi Viewer</h1>
        <div class="user-info">
            <span>Welcome, <?php echo htmlspecialchars($_SESSION['user']['fullname']); ?></span>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </header>

    <div class="container">
        <div class="section-controls">
            <button class="add-section-btn" onclick="addNewSection()">+ Add Section</button>
        </div>
        
        <div id="sectionsContainer"></div>
    </div>

    <template id="sectionTemplate">
        <div class="section">
            <button class="remove-section-btn" onclick="this.parentElement.remove()">×</button>
            <input type="text" class="url-input" placeholder="Paste YouTube URL here" oninput="updateVideo(this)">
            <div class="video-container">
                <iframe allowfullscreen></iframe>
            </div>
        </div>
    </template>

    <script>
        function addNewSection() {
            const template = document.getElementById('sectionTemplate');
            const clone = template.content.cloneNode(true);
            document.getElementById('sectionsContainer').appendChild(clone);
        }

        function updateVideo(input) {
            const videoId = getYouTubeId(input.value);
            const iframe = input.parentElement.querySelector('iframe');
            if(videoId) {
                iframe.src = `https://www.youtube.com/embed/${videoId}`;
            }
        }

        function getYouTubeId(url) {
            const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
            const match = url.match(regExp);
            return (match && match[2].length === 11) ? match[2] : null;
        }
    </script>
</body>
</html> 