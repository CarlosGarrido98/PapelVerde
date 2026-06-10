<?php

class Usuario {
    // Atributos con tipado estricto
    private ?int $idUsuario; // El ? permite que sea null antes de guardarse en la base de datos
    private string $nombre;
    private string $email;
    private string $contrasena;
    private ?string $imagenUrl; // Puede ser null si el usuario no tiene foto de perfil
    private bool $esAdministrador;

    public ?string $sexo;
    private ?string $fechaNacimiento;
    public ?string $direccion;
    private ?string $pais;
    private ?string $tarjetaCredito;

    private bool $activarNotificaciones;
    private bool $recibirRevistaDigital;

    // Constructor para inicializar el objeto
    public function __construct(
        ?int $idUsuario, 
        string $nombre, 
        string $email, 
        string $contrasena, 
        ?string $imagenUrl = null, 
        bool $esAdministrador = false,// Por defecto los usuarios creados no son admin

        ?string $sexo = null,
        ?string $fechaNacimiento = null,
        ?string $direccion = null,
        ?string $pais = null,
        ?string $tarjetaCredito = null,

        bool $activarNotificaciones = false,
        bool $recibirRevistaDigital = false

    ) {
        $this->idUsuario = $idUsuario;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->contrasena = $contrasena;
        $this->imagenUrl = $imagenUrl;
        $this->esAdministrador = $esAdministrador;

        $this->sexo = $sexo;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->direccion = $direccion;
        $this->pais = $pais;
        $this->tarjetaCredito = $tarjetaCredito;
        $this->activarNotificaciones = $activarNotificaciones;
        $this->recibirRevistaDigital = $recibirRevistaDigital;
    }


    // GETTERS (Para obtener los valores)

    public function getIdUsuario(): ?int {
        return $this->idUsuario;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getContrasena(): string {
        return $this->contrasena;
    }

    public function getImagenUrl(): ?string {
        return $this->imagenUrl;
    }

    // En booleanos se suele usar "is" o "has" en vez de "get" por legibilidad
    public function isAdministrador(): bool {
        return $this->esAdministrador;
    }

        public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function getFechaNacimiento(): ?string
    {
        return $this->fechaNacimiento;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function getPais(): ?string
    {
        return $this->pais;
    }

    public function getTarjetaCredito(): ?string
    {
        return $this->tarjetaCredito;
    }

    public function isActivarNotificaciones(): bool
    {
        return $this->activarNotificaciones;
    }

    public function isRecibirRevistaDigital(): bool
    {
        return $this->recibirRevistaDigital;
    }


    // SETTERS (Para modificar los valores)
    

    public function setIdUsuario(int $idUsuario): void {
        $this->idUsuario = $idUsuario;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

  
    public function setContrasena(string $contrasena): void {
        $this->contrasena = $contrasena;
    }

    public function setImagenUrl(?string $imagenUrl): void {
        $this->imagenUrl = $imagenUrl;
    }

    public function setEsAdministrador(bool $esAdministrador): void {
        $this->esAdministrador = $esAdministrador;
    }

        public function setSexo(?string $sexo): void
    {
        $this->sexo = $sexo;
    }

    public function setFechaNacimiento(?string $fechaNacimiento): void
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function setDireccion(?string $direccion): void
    {
        $this->direccion = $direccion;
    }

    public function setPais(?string $pais): void
    {
        $this->pais = $pais;
    }

    public function setTarjetaCredito(?string $tarjetaCredito): void
    {
        $this->tarjetaCredito = $tarjetaCredito;
    }

    public function setActivarNotificaciones(bool $activarNotificaciones): void
    {
        $this->activarNotificaciones = $activarNotificaciones;
    }

    public function setRecibirRevistaDigital(bool $recibirRevistaDigital): void
    {
        $this->recibirRevistaDigital = $recibirRevistaDigital;
    }


     public static function registrar(
        mysqli $conexion,
        string $nombre,
        string $email,
        string $contrasena,
        ?string $sexo,
        ?string $fechaNacimiento,
        ?string $direccion,
        ?string $pais,
        ?string $tarjetaCredito,
        bool $notificaciones,
        bool $revista
    ): bool {

        $passwordHash = password_hash(
            $contrasena,
            PASSWORD_DEFAULT
        );

        $imagenPorDefecto =
            'img/imgUsuarios/default.webp';

        $sql = "
            INSERT INTO usuarios
            (
                nombre,
                email,
                contrasena,
                sexo,
                fecha_nacimiento,
                direccion,
                pais,
                tarjeta_credito,
                activar_notificaciones,
                recibir_revista_digital,
                imagenURL,
                admin
            )
            VALUES
            (
                '$nombre',
                '$email',
                '$passwordHash',
                '$sexo',
                '$fechaNacimiento',
                '$direccion',
                '$pais',
                '$tarjetaCredito',
                " . ($notificaciones ? 1 : 0) . ",
                " . ($revista ? 1 : 0) . ",
                '$imagenPorDefecto',
                0
            )
        ";

        return mysqli_query(
            $conexion,
            $sql
        );
    }

    // Método para actualizar el perfil del usuario
    public static function actualizarPerfil(
        mysqli $conexion,
        int $idUsuarios,
        string $nombre,
        string $email,
        ?string $sexo,
        ?string $fechaNacimiento,
        ?string $direccion,
        ?string $pais,
        ?string $tarjetaCredito,
        bool $notificaciones,
        bool $revista
    ): bool {

    $sql = "
        UPDATE usuarios
        SET
            nombre = '$nombre',
            email = '$email',
            sexo = '$sexo',
            fecha_nacimiento = '$fechaNacimiento',
            direccion = '$direccion',
            pais = '$pais',
            tarjeta_credito = '$tarjetaCredito',
            activar_notificaciones = " . ($notificaciones ? 1 : 0) . ",
            recibir_revista_digital = " . ($revista ? 1 : 0) . "
        WHERE idUsuarios = $idUsuarios
    ";

    return mysqli_query($conexion, $sql);
}


}