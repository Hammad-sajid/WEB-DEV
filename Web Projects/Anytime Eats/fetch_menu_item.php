<?php
include 'connection.php'; // Include your database connection

if (isset($_POST['category'])) {
    $category = $_POST['category'];

    // Function to fetch menu items based on category
    function getMenuItemsByCategory($category) {
        global $con;
        $query = "SELECT * FROM menu_items WHERE category = '$category'";
        $result = mysqli_query($con, $query);

        $menuItems = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $menuItems[] = $row;
        }

        return $menuItems;
    }

    $menuItems = getMenuItemsByCategory($category);

    foreach ($menuItems as $item) {
        echo '
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="' . $item['image'] . '" class="card-img-top" alt="' . $item['name'] . '">
                    <div class="card-body">
                        <h5 class="card-title">' . $item['name'] . '</h5>
                        <p class="card-text">' . $item['description'] . '</p>
                        <p class="card-text"><strong>Price: </strong>' . $item['price'] . '</p>
                    </div>
                </div>
            </div>
        ';
    }
}
?>
