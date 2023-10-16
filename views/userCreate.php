<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
</head>
<body>
    <h1>Create User</h1>
    <form method="post" action="index.php?route=create_user">
        <label for="nama_user">Name:</label>
        <input type="text" name="nama_user" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="birthdate">Birthdate:</label>
        <input type="date" name="birthdate" required><br>

        <label for="id_role">Role:</label>
        <select name="id_role" required>
            <!-- You can populate this dropdown with roles from the database -->
            <option value="1">Role 1</option>
            <option value="2">Role 2</option>
            <!-- Add more options as needed -->
        </select><br>

        <label for="alamat">Address:</label>
        <textarea name="alamat" required></textarea><br>

        <input type="submit" value="Create User">
    </form>
    <a href="index.php?route=list_users">Back to User List</a>
</body>
</html>