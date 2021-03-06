@extends('layouts/plantilla')

@section('cabecera')
INSERTAR REGISTROS
@endsection


@section('contenido')<!--FORMULARIO DE INGRESO DE REGISTROS-->
<div class="card border-primary">
    <form action="/servicios" method="POST">

        @if(count($errors)>0)
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table >

            <tr>
                <td>Fecha envio: </td>
                <td>
                    <input type="date" id="start" name="fechaenvio"
                    value="{{ old('fechaenvio', date("Y-m-d")) }}"
                    min="2018-01-01" max="{{ date("y-m-d")}}">

                    {{ csrf_field() }}<!--permite enviar datos sin login-->
                    {!! $errors->first('fechaenvio','<div class="invalid-feedback">:message</div>') !!}
                </td>

            </tr>



            <tr>
                <td>Nombre: </td>
                <td>
                <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control {{ $errors->has('nombre')?'is-invalid':'' }}">
                    {{ csrf_field() }}<!--permite enviar datos sin login-->
                    {!! $errors->first('nombre','<div class="invalid-feedback">:message</div>') !!}

                </td>
            </tr>

            <tr>
                <td>Descripcion: </td>
                <td>
                <input type="text" name="descripcion" value="{{ old('descripcion') }}" class="form-control {{ $errors->has('descripcion')?'is-invalid':'' }}">
                    {{ csrf_field() }}<!--permite enviar datos sin login-->
                    {!! $errors->first('descripcion','<div class="invalid-feedback">:message</div>') !!}
                </td>
            </tr>

            <tr>
                <td>Zona: </td>
                <td>
                    <select name="idzona" id="idzona" class="form-control {{ $errors->has('idzona')?'is-invalid':'' }}">
                        @foreach ($zonas as $zona)
                    <option value="{{ $zona->id }}" {{old('idzona')== $zona->id ? 'selected' :false}}>{{ $zona->nombre }}</option>
                        @endforeach
                    </select>
                    {{ csrf_field() }}<!--permite enviar datos sin login-->
                </td>
            </tr>

            <tr>
                <td>Proveedores</td>
                <td>
                    <select name="proveedor_id" class="form-control">
                        @foreach($proveedoresTable as $proveedor)
                            <option value="{{$proveedor->id}}" {{old('proveedor_id')== $proveedor->id ? 'selected' :false}}>{{$proveedor->nombre}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr>
                <td>Tipo cliente</td>
                <td >

                    <input type="radio" id="persona" name="tipocliente" value="Persona" {{old('tipocliente')=='Persona'? 'checked' :false}} class="{{ $errors->has('tipocliente')?'is-invalid':'' }}">
                    <label>Persona</label>
                    <input type="radio" id="empresa" name="tipocliente" value="Empresa" {{old('tipocliente')=='Empresa'? 'checked' :false}} class="{{ $errors->has('tipocliente')?'is-invalid':'' }}">
                    <label>Empresa</label>
                    {{ csrf_field() }}<!--permite enviar datos sin login-->
                    {!! $errors->first('tipocliente','<div class="invalid-feedback">:message</div>') !!}

                </td>
            </tr>

            <tr>
                <td>TipoFactura</td>
                <td>
                    @foreach($tipos as $tipo)
                        <input type="checkbox" name="tipofactura[]" value="{{$tipo->id}}" class="{{ $errors->has('tipofactura')?'is-invalid':'' }}"
                            @if (is_array(old('tipofactura')) && in_array($tipo->id,old('tipofactura')))
                               checked
                            @endif
                        >{{$tipo->nombre}}<br>

                    @endforeach
                        {{ csrf_field() }}<!--permite enviar datos sin login-->
                        {!! $errors->first('tipofactura','<div class="invalid-feedback">:message</div>') !!}
                </td>
            </tr>

            <tr>
                <td>Tarifa</td>
                <td>
                    @foreach($tarifasData as $tarifa)
                        <input type="checkbox" name="tarifasArray[]" value="{{$tarifa->id}}" class="{{ $errors->has('tarifasArray')?'is-invalid':'' }}"
                            @if (is_array(old('tarifasArray')) && in_array($tarifa->id,old('tarifasArray')))
                               checked
                            @endif
                        >{{$tarifa->nombre}}
                    @endforeach
                        {!! $errors->first('tarifasArray','<div class="invalid-feedback">:message</div>') !!}
                </td>
            </tr>


            <tr>
                <td colspan="" align="center">
                    <input type="submit" name="enviar" value="Enviar">
                </td>
                <td>
                    <input type="reset" name="borrar" value="Borrar">
                </td>
            </tr>




        </table>

    </form>
   </div>


@endsection


@section('pie')

@endsection
