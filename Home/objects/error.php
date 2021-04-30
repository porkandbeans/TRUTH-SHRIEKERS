<?php
if (isset($_GET["error"])) {
?>

    <div class="errorbox">
        <?php
        switch ($_GET["error"]) {
            case "nosignups":
                echo ("We are not currently allowing users to register accounts on the site.");
                break;
            case "notallowed":
                echo ("You are not allowed to access that.");
                break;
            case "emptyfields":
                echo ("You have left one or more fields empty! Fill out all the required fields before submitting data you silly goose.");
                break;
            case "notprepared":
                echo ("The SQL statement could not be prepared. That's technical jargon. What does it mean? Bad things. Very bad things. Don't let this happen again.");
                break;
            case "nouserfound":
                echo ("No user with that name exists. Is there a typo?");
                break;
            default:
                echo ("An error was specified, but a definition has not yet been written for it. Error name: " . $_GET["error"]);
                break;
        }

        ?></div><?php //I had no idea you could be this cheeky
            }

            if (isset($_GET["result"])) {
                ?>
    <div class="resultbox">
        <?php switch ($_GET["result"]) {
                    case "register":
                        echo "Account created successfully!";
                        break;
                    case "login":
                        echo "You are now logged in!";
                        break;
                    default:
                        echo "Something happened. Probably successfully. Here's the code: " . $_GET["result"];
                }
        ?>
    </div>
<?php
            }
?>