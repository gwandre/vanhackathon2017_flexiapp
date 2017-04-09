/*
 * Initialization scripts
 */
$(function()
{
	// Initialize script
	//
})

function editProduto(codigoProduto)
{
	// Set values to the form
	$("#frmProduto #codigo").val(codigoProduto);

	// Set trigger to confirm button
	$("#btnModalConfirmar").off("click").on("click", function() {
		//TODO
		alert("TODO: Gravar form produto codigo: " + codigoProduto)
	})
}