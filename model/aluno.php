<?php
// Inicia o bloco de codigo PHP.

// Cria a classe Aluno, que representa a model de aluno no MVC.
class Aluno
{
    // Declara uma propriedade privada para guardar a conexao com o banco.
    private $con;

    // Cria o metodo construtor, executado automaticamente ao criar um objeto Aluno.
    public function __construct($con)
    {
        // Guarda a conexao recebida dentro da propriedade da classe.
        $this->con = $con;
    }

    // Cria o metodo responsavel por listar todos os alunos cadastrados.
    public function listar()
    {
        // Monta o comando SQL que busca os alunos e os cursos.
        $sql = "
            SELECT
                aluno.id,
                aluno.nome,
                aluno.email,
                curso.nome AS curso
            FROM aluno
            LEFT JOIN curso
                ON curso.id = aluno.curso_id
            ORDER BY aluno.id ASC
        ";

        // Executa o comando SQL no banco de dados.
        $resultado = $this->con->query($sql);

        // Cria um array vazio para armazenar os alunos encontrados.
        $alunos = [];

        // Verifica se a consulta falhou.
        if (!$resultado) {
            // Retorna o array vazio caso aconteca algum erro na consulta.
            return $alunos;
        }

        // Percorre cada linha retornada pelo banco de dados.
        while ($linha = $resultado->fetch_assoc()) {
            // Adiciona a linha atual dentro do array de alunos.
            $alunos[] = $linha;
        }

        // Retorna o array completo com todos os alunos encontrados.
        return $alunos;
    }
}
?>