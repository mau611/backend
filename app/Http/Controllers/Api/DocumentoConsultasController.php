<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ConsentimientosInformados;
use App\Models\DocumentoConsulta;
use App\Models\ExamenesMedicos;
use App\Models\FotosControl;
use App\Models\IndicacionesMedicas;
use Aws\Exception\AwsException;
use Aws\S3\S3Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class DocumentoConsultasController extends Controller
{
    public function index()
    {
        $documentosConsultas = DocumentoConsulta::all();
        return $documentosConsultas;
    }

    public function store(Request $request)
    {
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('s3')->put('shanti/archivo.txt', "archivo creado");
            $image->move(public_path('storage'), $imageName);

            $documentoConsulta = new DocumentoConsulta();
            $documentoConsulta->nombre = $request->nombre;
            $documentoConsulta->consulta_id = $request->consulta_id;
            $documentoConsulta->save();
        }
    }

    public function indicacionesMedicas(Request $request, $pacId)
    {
        $s3 = new S3Client([
            'version' => 'latest',
            'region' => config('filesystems.disks.s3.region'),
            'credentials' => [
                'key' => config('filesystems.disks.s3.key'),
                'secret' => config('filesystems.disks.s3.secret'),
            ],
        ]);

        $bucketName = config('filesystems.disks.s3.bucket');
        $folderPath = 'cb/indicaciones_medicas/' . $pacId; // Ruta dentro del bucket donde guardarás las imágenes
        $image = $request->file('img'); // Obtener la imagen del formulario o de la solicitud
        $imageName = time() . '.' . $image->getClientOriginalExtension(); // Nombre que tendrá la imagen en S3
        try {
            $s3->putObject([
                'Bucket' => $bucketName,
                'Key' => $folderPath . '/' . $imageName,
                'Body' => fopen($image->getPathname(), 'rb'),
                //'ACL' => 'public-read', // Opcional: establecer permisos de lectura público
            ]);
            $indicacionesMedicas = new IndicacionesMedicas();
            $indicacionesMedicas->nombre = $imageName;
            $indicacionesMedicas->consulta_id = $request->consulta_id;
            $indicacionesMedicas->save();
            return response()->json(['message' => 'Imagen subida a S3 con éxito']);
        } catch (AwsException $e) {
            // Manejar cualquier excepción o error que pueda ocurrir al subir la imagen a S3
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function fotosControl(Request $request, $pacId)
    {
        $s3 = new S3Client([
            'version' => 'latest',
            'region' => config('filesystems.disks.s3.region'),
            'credentials' => [
                'key' => config('filesystems.disks.s3.key'),
                'secret' => config('filesystems.disks.s3.secret'),
            ],
        ]);

        $bucketName = config('filesystems.disks.s3.bucket');
        $folderPath = 'cb/fotos_control/' . $pacId; // Ruta dentro del bucket donde guardarás las imágenes
        $images = $request->file('images'); // Obtener la imagen del formulario o de la solicitud
        try {
            foreach ($images as $image) {
                //$imageName = $image->getClientOriginalName(); // Obtener el nombre original de la imagen
                $imageName = time() . '.' . $image->getClientOriginalExtension(); // Nombre que tendrá la imagen en S3
                $s3->putObject([
                    'Bucket' => $bucketName,
                    'Key' => $folderPath . '/' . $imageName,
                    'Body' => fopen($image->getPathname(), 'rb'),
                ]);
                $fotosControl = new FotosControl();
                $fotosControl->nombre = $imageName;
                $fotosControl->consulta_id = $request->consulta_id;
                $fotosControl->save();
            }

            return response()->json(['message' => 'Imágenes subidas a S3 con éxito']);
        } catch (AwsException $e) {
            // Manejar cualquier excepción o error que pueda ocurrir al subir las imágenes a S3
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function examenesMedicos(Request $request, $pacId)
    {
        $s3 = new S3Client([
            'version' => 'latest',
            'region' => config('filesystems.disks.s3.region'),
            'credentials' => [
                'key' => config('filesystems.disks.s3.key'),
                'secret' => config('filesystems.disks.s3.secret'),
            ],
        ]);

        $bucketName = config('filesystems.disks.s3.bucket');
        $folderPath = 'cb/examenes_medicos/' . $pacId; // Ruta dentro del bucket donde guardarás las imágenes
        $image = $request->file('img'); // Obtener la imagen del formulario o de la solicitud
        $imageName = time() . '.' . $image->getClientOriginalExtension(); // Nombre que tendrá la imagen en S3
        try {
            $s3->putObject([
                'Bucket' => $bucketName,
                'Key' => $folderPath . '/' . $imageName,
                'Body' => fopen($image->getPathname(), 'rb'),
                //'ACL' => 'public-read', // Opcional: establecer permisos de lectura público
            ]);
            $examenesMedicos = new ExamenesMedicos();
            $examenesMedicos->nombre = $imageName;
            $examenesMedicos->consulta_id = $request->consulta_id;
            $examenesMedicos->save();
            return response()->json(['message' => 'Imagen subida a S3 con éxito']);
        } catch (AwsException $e) {
            // Manejar cualquier excepción o error que pueda ocurrir al subir la imagen a S3
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function consentimientosInformados(Request $request, $pacId)
    {
        $s3 = new S3Client([
            'version' => 'latest',
            'region' => config('filesystems.disks.s3.region'),
            'credentials' => [
                'key' => config('filesystems.disks.s3.key'),
                'secret' => config('filesystems.disks.s3.secret'),
            ],
        ]);

        $bucketName = config('filesystems.disks.s3.bucket');
        $folderPath = 'cb/consentimientos_informados/' . $pacId; // Ruta dentro del bucket donde guardarás las imágenes
        $image = $request->file('img'); // Obtener la imagen del formulario o de la solicitud
        $imageName = $image->getClientOriginalName(); // Nombre que tendrá la imagen en S3
        try {
            $s3->putObject([
                'Bucket' => $bucketName,
                'Key' => $folderPath . '/' . $imageName,
                'Body' => fopen($image->getPathname(), 'rb'),
                //'ACL' => 'public-read', // Opcional: establecer permisos de lectura público
            ]);
            $consentimientosInformados = new ConsentimientosInformados();
            $consentimientosInformados->nombre = $imageName;
            $consentimientosInformados->consulta_id = $request->consulta_id;
            $consentimientosInformados->save();
            return response()->json(['message' => 'Imagen subida a S3 con éxito']);
        } catch (AwsException $e) {
            // Manejar cualquier excepción o error que pueda ocurrir al subir la imagen a S3
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function otrosDocumentos(Request $request, $pacId)
    {
        $s3 = new S3Client([
            'version' => 'latest',
            'region' => config('filesystems.disks.s3.region'),
            'credentials' => [
                'key' => config('filesystems.disks.s3.key'),
                'secret' => config('filesystems.disks.s3.secret'),
            ],
        ]);

        $bucketName = config('filesystems.disks.s3.bucket');
        $folderPath = 'cb/otros_documentos/' . $pacId; // Ruta dentro del bucket donde guardarás las imágenes
        $image = $request->file('img'); // Obtener la imagen del formulario o de la solicitud
        $imageName = $image->getClientOriginalName(); // Nombre que tendrá la imagen en S3
        try {
            $s3->putObject([
                'Bucket' => $bucketName,
                'Key' => $folderPath . '/' . $imageName,
                'Body' => fopen($image->getPathname(), 'rb'),
                //'ACL' => 'public-read', // Opcional: establecer permisos de lectura público
            ]);
            $documentoConsulta = new DocumentoConsulta();
            $documentoConsulta->nombre = $imageName;
            $documentoConsulta->consulta_id = $request->consulta_id;
            $documentoConsulta->save();
            return response()->json(['message' => 'Imagen subida a S3 con éxito']);
        } catch (AwsException $e) {
            // Manejar cualquier excepción o error que pueda ocurrir al subir la imagen a S3
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function obtenerArchivo($fileName, $folderName, $pacId)
    {
        $urlTemp = Storage::disk('s3')->temporaryUrl('cb/' . $folderName . '/' . $pacId . '/' . $fileName, now()->addMinutes(10));
        $url = Storage::disk('s3')->url('cb/' . $folderName . '/' . $pacId . '/' . $fileName);

        return response()->json(['url' => $url, 'urlTemp' => $urlTemp]);
    }

    public function show($id)
    {
        $documentoConsulta = DocumentoConsulta::find($id);
        return $documentoConsulta;
    }

    public function update(Request $request, $id)
    {
        $documentoConsulta = DocumentoConsulta::findOrFail($request->id);
        $documentoConsulta->nombre = $request->nombre;
        $documentoConsulta->consulta_id = $request->consulta_id;
        $documentoConsulta->save();
        return $documentoConsulta;
    }

    public function destroy($id)
    {
        $documentoConsulta = DocumentoConsulta::destroy($id);
        return $documentoConsulta;
    }
}
