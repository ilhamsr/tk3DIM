<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
</head>
<body>
    <h1>User List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td><?php echo $user['id_user']; ?></td>
                <td><?php echo $user['nama_user']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['role_name']; ?></td>
                <td>
                    <a href="index.php?route=edit_user&id=<?php echo $user['id_user']; ?>">Edit</a> |
                    <form method="post" action="index.php?route=delete_user">
                        <input type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>

            </tr>
        <?php } ?>
    </table>
    <a href="index.php?route=create_user">Create User</a>
</body>
</html>