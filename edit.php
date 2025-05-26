<?php
require '../config/database.php';
require '../utils/session.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$title, $content, $id]);

    header('Location: index.php');
}
?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    min-height: 100vh;
    background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
    background-size: 400% 400%;
    animation: gradientBG 15s ease infinite;
    display: flex;
    align-items: center;
    justify-content: center;
}
@keyframes gradientBG {
    0% {background-position: 0% 50%;}
    50% {background-position: 100% 50%;}
    100% {background-position: 0% 50%;}
}
.form-container {
    background: rgba(255,255,255,0.92);
    padding: 2.5rem 2rem 2rem 2rem;
    border-radius: 1.5rem;
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
    max-width: 500px;
    width: 100%;
}
.form-label {
    color: #23a6d5;
    font-weight: 600;
}
.btn-primary {
    background: linear-gradient(90deg, #e73c7e 0%, #23a6d5 100%);
    border: none;
    font-weight: 600;
    letter-spacing: 1px;
}
.btn-primary:hover {
    background: linear-gradient(90deg, #23a6d5 0%, #e73c7e 100%);
}
</style>

<div class="form-container mx-auto">
    <h3 class="text-center mb-4" style="color:#23a6d5;">Edit Post</h3>
    <form method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($post['title']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control" rows="5" required><?= htmlspecialchars($post['content']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Update Post</button>
        <a href="index.php" class="btn btn-secondary w-100 mt-2">Back</a>
    </form>
</div>