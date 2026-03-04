<?php 
class Logger 
{
  /* padroniza os loggers do mini projeto 
    MODO DE USO: passa o local aonde o a class esta sendo instanciada na intanciação da class,
    chama o metodo log() 
    arg1: informação o logger em si 
    arg2: nivel do logger ERROR, AVISO, SUCESSO, para simplificar não coloquei DEBUG
  */
    
    private string $local;

    public function __construct(string $local) {
        $this->local = strtoupper($local);
    }

    public function log(mixed $mensagem, string $nivel = 'INFO'): void {
        $nivelUpper = strtoupper($nivel);

        if (!is_string($mensagem)) {
            ob_start();
            var_dump($mensagem);
            $mensagem = rtrim(ob_get_clean());
        }

        printf("[%s] [%s]: %s\n", 
            $this->local,
            $nivelUpper, 
            $mensagem
        );
    }
}

