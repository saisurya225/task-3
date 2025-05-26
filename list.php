<?php
// This file displays a list of posts retrieved from the database.

require_once '../../config/database.php';
require_once '../models/Post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);
$stmt = $post->read();
$num = $stmt->rowCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post List</title>
</head>
<body>
    <h1>Posts</h1>
    <a href="create-form.php">Create New Post</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($num > 0): ?>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['content']); ?></td>
                        <td>
                            <a href="edit-form.php?id=<?php echo htmlspecialchars($row['id']); ?>">Edit</a>
                            <a href="delete-post.php?id=<?php echo htmlspecialchars($row['id']); ?>">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No posts found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>