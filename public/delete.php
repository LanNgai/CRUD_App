<?php
require "../common.php";
if (isset($_GET["id"])) {
    try {
        require_once '../src/DBconnect.php';
        $id = $_GET["id"];
        $sql = "DELETE FROM users WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $success = "User " . $id . " successfully deleted";
    } catch (PDOException $e) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

try {
    require_once '../src/DBconnect.php';
    $sql = "SELECT * FROM users";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "templates/header.php"; ?>
<h2>Delete users</h2>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email Address</th>
        <th>Age</th>
        <th>Location</th>
        <th>Date</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
        <tr>
            <td><?php echo clean($row["id"]); ?></td>
            <td><?php echo clean($row["firstname"]); ?></td>
            <td><?php echo clean($row["lastname"]); ?></td>
            <td><?php echo clean($row["email"]); ?></td>
            <td><?php echo clean($row["age"]); ?></td>
            <td><?php echo clean($row["location"]); ?></td>
            <td><?php echo clean($row["date"]); ?> </td>
            <td><a href="delete.php?id=<?php echo clean($row["id"]);
                ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<a href="index.php">Back to home</a>

<?php require "templates/footer.php" ?>

