<?php

require_once __DIR__ . '/../view/mainView.php';
require_once __DIR__ . '/doctorController.php';
require_once __DIR__ . '/pacienteController.php';
require_once __DIR__ . '/turnoController.php';

class MenuController {
    private MainView $view;
    private DoctorController $doctorController;
    private PacienteController $pacienteController;
    private TurnoController $turnoController;

    public function __construct() {
        $this->view = new MainView();
        $this->doctorController = new DoctorController();
        $this->pacienteController = new PacienteController();
        $this->turnoController = new TurnoController();
    }

    public function ejecutar() {
        while (true) {
            $this->view->mostrarMenuPrincipal();
            $opcion = $this->view->obtenerOpcion();

            switch ($opcion) {
                case 1:
                    $this->doctorController->menu();
                    break;
                case 2:
                    $this->pacienteController->menu();
                    break;
                case 3:
                    $this->turnoController->menu();
                    break;
                case 4:
                    $this->view->mostrarMensaje("¡Gracias por usar la aplicación!");
                    exit(0);
                default:
                    $this->view->mostrarMensaje("Opción inválida. Intente nuevamente.");
            }
        }
    }
}
?>