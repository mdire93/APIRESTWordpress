<?php

namespace App\Controller;

use App\Entity\Clientes;
use App\Entity\Cuentacliente;
use App\Entity\Cuentas;
use App\Entity\Historialpagos;
use App\Entity\Prestamos;
use App\Entity\Prestamocliente;


use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class DefaultController extends AbstractController {

    public function consulta($con,$nombre){
        if ($nombre=="clientes"){
            $bd = $con->getRepository(Clientes::class);
        } elseif($nombre=='cuentas'){
            $bd = $con->getRepository(Cuentas::class);
        }elseif($nombre=='cuentacliente'){
            $bd = $con->getRepository(Cuentacliente::class);
        }elseif($nombre=='prestamos'){
                $bd = $con->getRepository(Prestamos::class);
        }elseif($nombre=='prestamocliente'){
            $bd = $con->getRepository(Prestamocliente::class);
        }else {
            $bd = $con->getRepository(Historialpagos::class);
        }
        
        return  $bd->findAll();
    }
    
    /**
     * @Route ("/logout")
     */
    public function logout(Request $request) {
        $con=$this->conexion();
        $cliente=$this->obtenersesion($request->get('credencial'));
        $response= new Response();
        if ($cliente){
            $cliente->setCredencial('');
            $con->persist($cliente);
            $con->flush();
            $response->setContent(json_encode(array(
                'Sesion cerrada'
            )));

        } else {
            $response->setContent(json_encode(array(
                'No existe niguna sesión'
            )));
        }
        $response->headers->set('Content-Type', 'application/json');
      return  $response;  
    }

public function conexion (){

    return $this->getDoctrine()->getManager();
}
// obtengo cliente sesion
public function obtenersesion($token){
     
    $con = $this->getDoctrine()->getManager();
    $bd = $con->getRepository(Clientes::class);

    return $bd->findOneBy( array ('credencial' => $token));
}

    
     /**
         * @Route("/logearse"), name="logearse"
         * Funcion que comprueba si hay algun usuario 
         * si hay busca si coincide la pass
         */
        public function logearse(Request $request){
            
            $response = new Response();
            $codigo=401;
            $con= $this->getDoctrine()->getRepository(Clientes::class);
            $usuario_login= new Clientes();
            
    
            if ($con->findOneBy( array ('usuario' => $request->get('usuario') ) ) ){
            $usuario_login= $con->findOneBy( array ('usuario' => $request->get('usuario') ) ) ;

            if ($usuario_login->getPass() == md5($request->get('pass') )){
               
                // inicio sesion       
                $codigo=200;
                $usuario_login->setCredencial(md5($usuario_login->getNombre().date('d-m-Y h:i:s')));
                $this->conexion()->persist($usuario_login);
                $this->conexion()->flush(); 
                }
            }

            if ($codigo===200){
            $response->setContent(json_encode(array(
                'nombre' => $usuario_login->getNombre(),
                'apellidos' => $usuario_login->getApellidos(),
                'Credencial' => $usuario_login->getCredencial()
            )));
        } else {
            $response->setContent(json_encode(array(
                'Usuario o contraseña no válidos'
            )));
        }
            $response->headers->set('Content-Type', 'application/json');
          return  $response;  
    }

    /**
     * @Route("/cuentas")
     */
    public function cuenta_cliente(Request $request){
        $response = new Response();
        $usuario=$this->obtenersesion($request->get('credencial'));
            if ($usuario){
            $con= $this ->conexion();

            $bd_cuentas= $con->getRepository(Cuentas::class);
            $miscuentas= $bd_cuentas->findBy( array('titular'=>$usuario->getId()));
            
            $miarray_cuentas= [];
            
                foreach ($miscuentas as $micuenta){
                    $bd_clientes=$con->getRepository(Clientes::class);
                    $titular= $bd_clientes->findOneBy( array('id'=>$micuenta->getTitular()));

                    $micuenta= [
                        'id_cuenta' => $micuenta->getId(),
                        'cuenta' => $micuenta->getCuenta(),
                        'usuarioTitular' => $titular->getUsuario(),
                        'titular' => $titular->getNombre().','.$titular->getApellidos()
                    ];
                    array_push($miarray_cuentas,$micuenta);
                    }

            $response->setContent(json_encode(array(
                $miarray_cuentas
             )));
            }
        else {
            $response->setContent(json_encode(array(
                "No hay sesion de usuario. Acceso denegado"
             )));
        }
        $response->headers->set('Content-Type', 'application/json');

      return $response;
    }

    /**
     * @Route("/verpagos/{id}")
     */
    public function verpagos(Cuentas $cuenta, Request $request){
        $con= $this->conexion(); 
        $response = new Response();
        $cliente=$this->obtenersesion($request->get('credencial'));

        if ($cliente){
        $historial= $con->getRepository(Historialpagos::class);
        $mihistorial = $historial->findBy( array('id_cuenta'=> $cuenta->getId()) );
        $array_mihistorial=[];
        foreach ($mihistorial as $pago){
            
            $array_pago=[
            'id_cuenta' => $cuenta->getId(),
            'operacion' => $pago->getOperacion().' de '.$pago->getCantidad().'€',
            'fecha' => $pago->getFecha()
            ];
            array_push($array_mihistorial,$array_pago);
        }
        
        $response->setContent(json_encode(array(
            $array_mihistorial
        )));
    } else {
        $response->setContent(json_encode(array(
            "No hay sesion de usuario. Acceso denegado"
         )));
    }
        $response->headers->set('Content-Type', 'application/json');
       
      return $response;

    }

    /**
     * @Route("/prestamos")
     */
    public function prestamos(Request $request){
        $con=$this->conexion();
        $cliente= $this->obtenersesion($request->get('credencial'));
        $response = new Response();
        if ($cliente){
            $prestamos=$this->consulta($con,'prestamos');
            
            $array_prestamos=[];

            foreach ($prestamos as $prestamo){
                $array_prestamo= [
                'prestamo' => $prestamo->getNombre(),
                'cantidad' => $prestamo->getCantidad().'€ durante '.$prestamo->getDuracion(),
                'tae' => $prestamo->getTae(),
                'total_a_devolver' => $prestamo->getDevolver()
                ];
                array_push($array_prestamos,$array_prestamo);
            }

            $response->setContent(json_encode(array(
                $array_prestamos
            )));
        } else{
            $response->setContent(json_encode(array(
                "No hay sesion de usuario. Acceso denegado"
             )));
        }
        $response->headers->set('Content-Type', 'application/json');
        
      return $response;

       
    }
    /**
     * @Route("/mis_prestamos")
     */
    public function mis_prestamos(Request $request){
        $con=$this->conexion();
        $cliente=$this->obtenersesion($request->get('credencial'));
        $response = new Response();
        if ($cliente){
            $bd = $con->getRepository(Prestamocliente::class);
            $mis_prestamos = $bd->findBy( array ('id_cliente' => $cliente->getId()));
            $array_misprestamos= [];
        

                foreach( $mis_prestamos as $miprestamo){
                    $bd_prestamos=$con->getRepository(Prestamos::class);
                    $prestamo= $bd_prestamos->findOneBy( array('id'=>$miprestamo->getIdPrestamo()) );
                    $array_miprestamo =[
                    'id_prestamo' =>$prestamo->getId(),
                    'prestamo' => $prestamo->getNombre(),
                    'cantidad' => $prestamo->getCantidad().'€ durante '.$prestamo->getDuracion(),
                    'tae' => $prestamo->getTae(),
                    'total_a_devolver' => $prestamo->getDevolver()
                    ];
                    array_push($array_misprestamos,$array_miprestamo);
                }
                $response->setContent(json_encode(array(
                    $array_misprestamos
                )));
            if (!$mis_prestamos){
            $response->setContent(json_encode(array(
                "No tienes solicitado ningun prestamo"
             )));
            }
        } else {
            $response->setContent(json_encode(array(
                "No hay sesion de usuario. Acceso denegado"
             )));
        }
        $response->headers->set('Content-Type', 'application/json');
        
      return $response;

        
    }

    /**
     * @Route("/solicitar_prestamo/{id}")
     */
    public function solicitar_prestamo(Prestamos $prestamo, Request $request){
        $con=$this->conexion();
        $cliente=$this->obtenersesion($request->get('credencial'));
        $response = new Response();
        if($cliente){
            $mi_prestamo= new Prestamocliente();
            $mi_prestamo->setIdCliente($cliente->getId());
            $mi_prestamo->setIdPrestamo($prestamo->getId());
        

            $con->persist($mi_prestamo);
            $con->flush(); 

            
            $response->setContent(json_encode(array(
            'prestamo solicitado ' => $prestamo->getNombre(),
            'cantidad' => $prestamo->getCantidad().'€ durante '.$prestamo->getDuracion(),
            'tae' => $prestamo->getTae(),
            'total_a_devolver' => $prestamo->getDevolver(),
            'solicitado por' => $cliente->getNombre().','.$cliente->getApellidos()
        )));
    
        $this->ingreso($prestamo, $request->get('id_cuenta'),$request->get('credencial'));
        } else{
            $response->setContent(json_encode(array(
                "No hay sesion de usuario. Acceso denegado"
             )));
        }
    $response->headers->set('Content-Type', 'application/json');
  
    return $response;
    }

    /**
     *  prestamo a historial de pagos 
     * recibo el prestamo
     */
    public function ingreso(Prestamos $miprestamo, $id_cuenta, $token){
        $con=$this->conexion();
        $cliente=$this->obtenersesion($token);

        $ingreso= new Historialpagos();
        $ingreso->setIdCuenta($id_cuenta);
        $ingreso->setIdCuentacliente($cliente->getId());
        
        $ingreso->setCantidad($miprestamo->getCantidad());
        $ingreso->setFecha(date('d-m-Y h:i:s'));
        $ingreso->setOperacion("Ingreso");
 
        $response = new Response();
        $response->setContent(json_encode(array(
        'ingreso de dinero' => $ingreso->getCantidad().'€' 
        
      )));
    
    $response->headers->set('Content-Type', 'application/json');
    
        $con->persist($ingreso);
        $con->flush(); 
      return $response;
    }

    /**
     * @Route("/devolver/{id}")
     */
    public function devolver(Prestamos $prestamo, Request $request){
        $response = new Response();
        $con=$this->conexion();
        $cliente=$this->obtenersesion($request->get('credencial'));
        
        if($cliente){
           
           $response->setContent(json_encode(array(
           'cliente ' => $cliente->getNombre().', '.$cliente->getApellidos(),
           'cantidad_pagada' => $prestamo->getDevolver(),
           'prestamo_devuelto' =>$prestamo->getNombre()
       )));
       $response->headers->set('Content-Type', 'application/json');
       $response->send();
    
        //obtener cuentacliente 
        $bd_cuentacliente= $con->getRepository(Cuentacliente::class);
        // busco en cuentacliente el id del cliente 
        $cuentasclientes= $bd_cuentacliente->findBy( array('id_cliente'=>$cliente->getId()) );
        //busco el id de la cuenta 
        $id_cuentacliente=3;
        foreach( $cuentasclientes as $cuentacliente){
            if ($cuentacliente->getIdCuenta() == $request->get('id_cuenta')){
                $id_cuentacliente=$cuentacliente->getId();
            }
        }
        
       $pago= new Historialpagos();
        $pago->setIdCuenta($request->get('id_cuenta'));
        $pago->setIdCuentacliente($id_cuentacliente);
        
        $pago->setCantidad($prestamo->getDevolver());
        $pago->setFecha(date('d-m-Y h:i:s'));
        $pago->setOperacion("Transferencia");
 
        $response = new Response();
        $response->setContent(json_encode(array(
        'transferencia de dinero' => $pago->getCantidad().'€' 
        
      )));
    
        $con->persist($pago);
        $con->flush(); 
    } else {
        
        $response->setContent(json_encode(array(
            "No hay sesion de usuario. Acceso denegado"
         )));
    }
    $response->headers->set('Content-Type', 'application/json');
    //$response->send();
        return $response;
    }

    /**
     * @Route ("/recuperar_pass")
     */
    public function recuperar(Request $request){

        $con= $this->conexion();
        $bd_clientes= $con->getRepository(Clientes::class);
 $response = new Response();
        if ($cliente= $bd_clientes->findOneBy( array('id'=>$request->get('id_cliente')) ) ){
            $cliente->setPass(md5($request->get('pass')));
            $con->persist($cliente);
            $con->flush();
        
       
        $response->setContent(json_encode(array(
        'contraseña cambiada correctamente'
        
      )));
    
    $response->headers->set('Content-Type', 'application/json');

        }

        
        return $response ;
    }
}

?>