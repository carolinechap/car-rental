<?php

class AuthController extends Db {


    /**
     * Signup page
     */
    public function signup() {

        $em = new EmployeeManager;

        /**
         * Traitements pour le cas de la route POST
         */

        if (!empty($_POST)) {
            // Validation e-mail: vérification de l'unicité

            $am = new AdminManager;

            $adminDb = $am->find([
                ['email', '=', $_POST['email'] ]
            ]);
            // SI $userDb existe, alors l'e-mail n'est pas unique,
            // donc l'utilisateur existe, donc on redirige vers la page Login.
            if ($adminDb)  {
                throw new Exception('Un utilisateur avec cette adresse existe déjà.');
            }
            // SINON : l'user n'existe pas, on peut créér l'utilisateur.
            else {
                // Comparaison de password et password_confirm
                if ($_POST['password'] === $_POST['password_confirm']) {
                    // Créer l'utilisateur :

                    $employee = $em->findOne($_POST['id_employee']);
                    $admin = new Admin($_POST['email'], $_POST['password'], $employee);

                    $am->save($admin);
                    // Si mon user a bien été enregistré alors il a un ID (->save() retourne en effet un ID)
                    // Si c'est le cas je peux créer une session
                    if ( intval($admin->id() ) > 0 ) {
                        // Session :
                        // On passe notre objet User en session afin d'y accéder de partout dans le code
                        $_SESSION['admin'] = serialize($admin);
                        // Maintenant que l'utilisateur est créé et la session créée, on
                        // redirige vers la page d'accueil
                        Header('Location: ' . url('admin'));
                    }
                    throw new Exception('Une erreur est survenue lors de la création de l`utilisateur.');
                }
                else {
                    throw new Exception('Les mots de passe ne correspondent pas.');
                }
            }
        }

        $employees = $em->findAll();
        view('pages.signup', compact('employees'));
    }
    /**
     * Login page
     */
    public function login() {
        if (!empty($_POST)) {

            //  vérifier que le User existe en BDD avec par exemple :

            $am = new AdminManager;
            $adminDb = $am->find([
                ['email', '=', $_POST['email']]
            ]);

            // SI l'utilisateur existe, alors il est logué :
            if ($adminDb) {
                $adminDb = $adminDb[0];
                if (password_verify( $_POST['password'], $adminDb->password() ) ) {
                    // Anti-brute-force
                    sleep(1);
                    // Session :
                    // On passe notre objet User en session afin d'y accéder de partout dans le code
                    $_SESSION['admin'] = serialize($adminDb);
                    // Maintenant que l'utilisateur est créé et la session créée, on
                    // redirige vers la page d'accueil
                    Header('Location: ' . url('admin'));
                }
                else {
                    throw new Exception('Les identifiants sont invalides.');
                }
            }
            // Si l'user existe
            else {
                throw new Exception('Les identifiants sont invalides.');
                //Header('Location: ' . url('signup'));
            }
        }
        view('pages.login');
    }
    /**
     * Logout action
     */
    public function logout() {
        // On detruit la session de l'user avec session_destroy
        session_destroy();
        // Redirection vers la page d'accueil
        Header('Location: ' . url('/'));
    }
}