<?php
    namespace clientepc\kesto\Models;
    use clientepc\kesto\Models\Conexion;

    class Proveedores extends Conexion {
        private $id_proveedor;
        private $razon_social;
        private $nombreC;
        private $telefono_prncpl;
        private $telefono_scndr;
        private $correo;
        private $active;

        public function __construct(
            $id_proveedor = null, 
            $razon_social = null, 
            $nombreC = null, 
            $telefono_prncpl = null, 
            $telefono_scndr = null, 
            $correo = null, 
            $active = 1
        ) {
            parent::__construct();
            $this->id_proveedor = $id_proveedor;
            $this->razon_social = $razon_social;
            $this->nombreC = $nombreC;
            $this->telefono_prncpl = $telefono_prncpl;
            $this->telefono_scndr = $telefono_scndr;
            $this->correo = $correo;
            $this->active = $active;
        }

        public function getIdProveedor() { return $this->id_proveedor; }
        public function getRazonSocial() { return $this->razon_social; }
        public function getNombreC() { return $this->nombreC; }
        public function getTelefonoPrncpl() { return $this->telefono_prncpl; }
        public function getTelefonoScndr() { return $this->telefono_scndr; }
        public function getCorreo() { return $this->correo; }
        public function getActive() { return $this->active; }

        public function setIdProveedor($id_proveedor) { $this->id_proveedor = $id_proveedor; return $this; }
        public function setRazonSocial($razon_social) { $this->razon_social = $razon_social; return $this; }
        public function setNombreC($nombreC) { $this->nombreC = $nombreC; return $this; }
        public function setTelefonoPrncpl($telefono_prncpl) { $this->telefono_prncpl = $telefono_prncpl; return $this; }
        public function setTelefonoScndr($telefono_scndr) { $this->telefono_scndr = $telefono_scndr; return $this; }
        public function setCorreo($correo) { $this->correo = $correo; return $this; }
        public function setActive($active) { $this->active = $active; return $this; }

        public function insert() {
            $sql = "INSERT INTO proveedores (razon_social, nombreC, telefono_prncpl, telefono_scndr, correo, active) 
                    VALUES (:razon_social, :nombreC, :telefono_prncpl, :telefono_scndr, :correo, :active)";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(":razon_social", $this->razon_social);
            $stmt->bindParam(":nombreC", $this->nombreC);
            $stmt->bindParam(":telefono_prncpl", $this->telefono_prncpl);
            $stmt->bindParam(":telefono_scndr", $this->telefono_scndr);
            $stmt->bindParam(":correo", $this->correo);
            $stmt->bindParam(":active", $this->active);
            
            return $stmt->execute();
        }

        public function search() {
            $sql = "SELECT * FROM proveedores WHERE active = 1";
            $stmt = $this->prepare($sql);
            if ($stmt->execute()) {
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            } else {
                return [];
            }
        }

        public function searchInactive() {
            $sql = "SELECT * FROM proveedores WHERE active = 0";
            $stmt = $this->prepare($sql);
            if ($stmt->execute()) {
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            } else {
                return [];
            }
        }

        public function searchId($id_proveedor) {
            $sql = "SELECT * FROM proveedores WHERE id_proveedor = :id_proveedor";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(":id_proveedor", $id_proveedor);
            if ($stmt->execute()) {
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        }

        public function searchRazonSocial($razon_social) {
            $sql = "SELECT * FROM proveedores WHERE razon_social = :razon_social";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(":razon_social", $razon_social);
            if ($stmt->execute()) {
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        }

        public function update() {
            $sql = "UPDATE proveedores 
                    SET razon_social = :razon_social, nombreC = :nombreC, telefono_prncpl = :telefono_prncpl, 
                        telefono_scndr = :telefono_scndr, correo = :correo, active = :active 
                    WHERE id_proveedor = :id_proveedor";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(":id_proveedor", $this->id_proveedor);
            $stmt->bindParam(":razon_social", $this->razon_social);
            $stmt->bindParam(":nombreC", $this->nombreC);
            $stmt->bindParam(":telefono_prncpl", $this->telefono_prncpl);
            $stmt->bindParam(":telefono_scndr", $this->telefono_scndr);
            $stmt->bindParam(":correo", $this->correo);
            $stmt->bindParam(":active", $this->active);
            
            return $stmt->execute();
        }

        public function delete() {
            $sql = "UPDATE proveedores SET active = 0 WHERE id_proveedor = :id_proveedor";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(":id_proveedor", $this->id_proveedor);
            
            return $stmt->execute();
        }

        public function active() {
            $sql = "UPDATE proveedores SET active = 1 WHERE id_proveedor = :id_proveedor";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(":id_proveedor", $this->id_proveedor);
            
            return $stmt->execute();
        }
    }
?>