<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/webp" href="../Images/Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .dropdown-custom {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: fixed;
            border-radius: 5px;
            background-color: #ffff;
            width: 200px; /* Adjust the width as needed */
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
            border-radius: 5px;
        }

        .show {
            display: block;
        }
    </style>
</head>
<body>
    <div class="col-1">
        <aside>
            <div class="my-2 py-1 mx-2 px-3">
                <img src="../Images/Logo.png" width="50px" height="50px" style="cursor: pointer;">  
            </div>
            <div class="container my-2 mx-2 pt-2 pb-3 px-4 rounded align-items-center" style="width: 75px; background: #23297A; display: flex; flex-direction: column; overflow: hidden;">
                <i class="bi bi-wallet2 fs-1 mt-2 mb-1" style="color: white; cursor: pointer;" title="Budget Your Finances" onclick="window.location.href='homePage.php'"></i>
                <i class="bi bi-cash-coin fs-1 mb-1" style="color: white; cursor: pointer;" title="Input Your Expenditure" onclick="window.location.href='expenditurePage.php'"></i>
                <i class="bi bi-bullseye fs-1 mb-1" style="color: white; cursor: pointer;" title="Set Your Targets" onclick="window.location.href='targetsPage.php'"></i>
                <i class="bi bi-youtube fs-1 mb-1" style="color: white; cursor: pointer;" title="Helpful Videos" onclick="window.location.href='videosPage.php'"></i>
                <i class="bi bi-question-circle-fill fs-1 mb-1" style="color: white; cursor: pointer;" title="Help" onclick="window.location.href='helpPage.php'"></i>
            </div>
            <div class="container my-2 mx-2 mb-2 pt-2 pb-3 px-4 rounded align-items-center" style="width: 75px; background: #23297A; display: flex; flex-direction: column; overflow: hidden;">
                <i class="bi bi-person-fill fs-1 mb-1" style="color: white; cursor: pointer;" title="Profile" onclick="window.location.href='profilePage.php'"></i>
                <div class="dropdown-custom">
                    <i class="bi bi-gear-fill fs-1 mb-1" style="color: white; cursor: pointer;" title="Settings"></i>
                    <div class="dropdown-content">
                        <a href="familyAccount.php" title="Create Family Account">Create Family Account</a>
                        <a href="viewAccounts.php" title="View Family Accounts">View Family Accounts</a>
                        <a href="logout.php" title="Logout">Logout</a>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropdown = document.querySelector('.dropdown-custom');
            const dropdownContent = document.querySelector('.dropdown-content');
            const gearIcon = document.querySelector('.bi-gear-fill');

            dropdown.addEventListener('click', function (event) {
                event.stopPropagation();
                dropdownContent.classList.toggle('show');
                const rect = gearIcon.getBoundingClientRect();

                dropdownContent.style.top = rect.top + 'px';
                dropdownContent.style.left = rect.right + 'px';

                const dropdownRect = dropdownContent.getBoundingClientRect();
                const viewportHeight = window.innerHeight;

                if (dropdownRect.bottom > viewportHeight) {
                    dropdownContent.style.top = (viewportHeight - dropdownRect.height - 10) + 'px';  // Adjust the 10px padding as needed
                }
            });

            // Close the dropdown if the user clicks outside of it
            window.addEventListener('click', function () {
                if (dropdownContent.classList.contains('show')) {
                    dropdownContent.classList.remove('show');
                }
            });
        });
    </script>
</body>
</html>
