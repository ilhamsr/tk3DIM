<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form method="post" action="index.php?route=edit_user">
        <input type="hidden" name="id_user" value="<?php echo $userData['id_user']; ?>">
        
        <label for="nama_user">Name:</label>
        <input type="text" name="nama_user" value="<?php echo $userData['nama_user']; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $userData['email']; ?>" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" value="<?php echo $userData['password']; ?>" required><br>

        <label for="birthdate">Birthdate:</label>
        <input type="date" name="birthdate" value="<?php echo $userData['birthdate']; ?>" required><br>

        <label for="id_role">Role:</label>
        <select name="id_role" required>
            <!-- You can populate this dropdown with roles from the database -->
            <option value="1" <?php if ($userData['id_role'] == 1) echo 'selected'; ?>>Role 1</option>
            <option value="2" <?php if ($userData['id_role'] == 2) echo 'selected'; ?>>Role 2</option>
            <!-- Add more options as needed -->
        </select><br>

        <label for="alamat">Address:</label>
        <textarea name="alamat" required><?php echo $userData['alamat']; ?></textarea><br>

        <input type="submit" value="Update User">
    </form>
    <a href="index.php?route=list_users">Back to User List</a>
</body>
</html>
