var btnCadastro=document.querySelector("#cadastrar")
var modal=document.querySelector(".modal")
var formCadastro=document.querySelector('#insert-form')
var formEditar=document.querySelector('#edit-form')
var table=document.querySelector("#table");
var editClose=document.querySelector('#edit-close');
var insertClose=document.querySelector('#insert-close');
var searchForm=document.querySelector('#search-form');
var busca=document.querySelector('#busca')

//seleciona e mostra somente a linha selecionada e adiciona a tabela
function showSingleRow(id,nome,sexo,cargo){
	let nomeFormatado=nome.replace('-',' ')
	while(table.firstChild){
		table.firstChild.remove()
	}
	let trh=document.createElement('tr');
	let tr=document.createElement('tr');
	let editar=document.createElement('button')
	let deletar=document.createElement('button')
	trh.innerHTML='<th>Id</th><th>Nome</th><th>Genero</th><th>Cargo</th> <th>Ação</th>'
	tr.innerHTML=`<td>${id}</td><td>${nomeFormatado}</td><td>${sexo}</td><td>${cargo}</td>	`
	editar.innerHTML='Editar'
	deletar.innerHTML='Deletar'
	editar.setAttribute('onclick',`editar(${id},"${nomeFormatado}","${sexo}","${cargo}")`)
	deletar.setAttribute('onclick',`deletar(${id})`)
	tr.appendChild(editar)
	tr.appendChild(deletar)
	table.appendChild(trh)
	table.appendChild(tr)
}
//faz a busca por um determinado registro no banco de dados.
searchForm.onkeyup=function(){
	let sugestao=document.querySelector('#sugestao')
	this.onsubmit=function(event){
		event.preventDefault();
	}
	fetch('request/buscar.php',{
		method:'POST',
		body:new FormData(this)
	})
	.then(res=>res.text())
	.then(data=>{
		if(busca.value==''){
			while(sugestao.firstChild){
				sugestao.firstChild.remove()
			}
			getData()
		}else{
			sugestao.innerHTML=data
		}
		
	})
	.catch(error=>{
		console.error(error)
	})
}
btnCadastro.onclick=function(){
	openModal(formCadastro);
	document.querySelectorAll('.insert-input')[0].focus()
	formCadastro.onsubmit=function(event){
	event.preventDefault()
		fetch('request/inserir.php',{
		method:"POST",
		body:new FormData(this)
	})
	.then(res=>res.json())
	.then(data=>{
		if(data.status=="sucesso"){
			document.querySelectorAll('.insert-input').forEach(i=>{
				i.value="";
			})
			closeModal()
			getData()
			
		}else{
			alert("ocorreu um erro: "+data.status);
		}
	})
	.catch(e=>{
		console.error(e)
	})
}
}

//deletar registro.
function deletar(id){
	if(confirm('deseja deletar esse registro?')){
		fetch('request/deletar.php?id='+id,{
		method:"DELETE"
	})
	.then(res=>res.json())
	.then(res=>{
		getData()
	})
	.catch(erro=>{
		console.error(erro)
	})

	}
	
}
//editar registro
function editar(id,n,s,c){
	openModal(formEditar);
	let userId=id
	let nome=document.querySelector("#nome")
	let genero=document.querySelector("#genero")
	let cargo=document.querySelector("#cargo")
	nome.value=n
	genero.value=s;
	cargo.value=c
	nome.focus()
	formEditar.onsubmit=function(event){
		event.preventDefault();
		fetch('request/atualizar.php?id='+userId,{
			method:'PUT',
			body:JSON.stringify({
				nome:nome.value,
				genero:genero.value,
				cargo:cargo.value
			})
		})
		.then(res=>res.json())
		.then(res=>{
			document.querySelectorAll('.edit-input').forEach(d=>{
				d.value=""
			})
			busca.value=''
			//fecha o modal
			closeModal()
			getData();
		})
		.catch(erro=>{
			console.error('ERROR: '+erro)
		})
	}
}

// criar/mostar tabela
function displayTable(arr){
	let trh=document.createElement('tr');
	trh.innerHTML='<th>Id</th><th>Nome</th><th>Genero</th><th>Cargo</th> <th>Ação</th>'
	table.appendChild(trh);
	arr.forEach(d=>{
		let tr=document.createElement('tr')
		let editar=document.createElement('button')
		let deletar=document.createElement('button')
		tr.innerHTML=`<td>${d.id}</td><td>${d.nome}<td>${d.sexo}</td><td>${d.cargo}`
		editar.innerHTML='Editar'
		deletar.innerHTML='Deletar'
		editar.setAttribute('onclick',`editar(${d.id},"${d.nome}","${d.sexo}","${d.cargo}")`)
		deletar.setAttribute('onclick',`deletar(${d.id})`)
		tr.appendChild(editar)
		tr.appendChild(deletar)
		table.appendChild(tr);
	})
}
function getData(){
	let sugestao=document.querySelector('#sugestao')
	//loop para evitar dados repitidos
	while(table.firstChild){
		table.firstChild.remove();
	}
	fetch('request/get.php')
	.then(res=>res.json())
	.then(data=>{
		if(data.status=='vazio'){
			table.innerHTML='<h3>não há nenhum registro!</h3>'
			searchForm.style.display='none'
			while(sugestao.firstChild){
				sugestao.firstChild.remove()
			}
		}else{
			displayTable(data)
			searchForm.style.display='flex'
			
		}
		
	})
	.catch(erro=>{
		console.error("erro="+erro)
	})
}
//abre o modal e e mostra o formulario que foi passado pelo parametro
function openModal(form){
	modal.style.display='flex'
	modal.appendChild(form)
	form.style.display='flex'
}
//fecha o modal e limpa os elementos filhos
function closeModal(){
	while(modal.firstChild){
		modal.firstChild.remove();
	}
		modal.style.display='none'
}

//fecha o modal se o usuario clicar fora do formulario
window.onclick=function(event){
	if(event.target==modal || event.target==editClose || event.target==insertClose ){
		closeModal()
		modal.style.display="none";
	}
	if(event.target != sugestao){
		sugestao.innerHTML=''
	}	
}
getData();