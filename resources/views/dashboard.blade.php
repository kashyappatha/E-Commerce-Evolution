@extends('layouts.app')

@section('title', '')

@section('contents')
    <style>
        /* Custom CSS */
        /* .email-scroll {
                                                                                    padding: 3px;
                                                                                    background-color: #f7f7f7;
                                                                                } */

        .email-scroll p {
            padding: 3px;
            background-color: #f7f7f7;
        }

        .text-muted {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 25px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-body h5 {
            margin-bottom: 10px;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }
    </style>
<tr>
    <td>
        <div style="display: flex; align-items: center; margin-top: 10px; margin-left: 3px;">
            <h3 style="display: inline-block; padding: 5px 8px; border-radius: 10px; font-weight: bold; margin-bottom: 0;">
                {{-- <marquee behavior="scroll" direction="up" scrollamount="4" loop="infinite"> --}}
                    <style>
                        @keyframes borderAnimation {
                          0% {
                            border-color: #2193b0;
                          }
                          25% {
                            border-color: #6dd5ed;
                          }
                          50% {
                            border-color: #ff9a8b;
                          }
                          75% {
                            border-color: #ff6a88;
                          }
                          100% {
                            border-color: #ff99ac;
                          }
                        }

                        @keyframes gradientEffect {
                          0% {
                            background-position: 0% 50%;
                          }
                          50% {
                            background-position: 100% 50%;
                          }
                          100% {
                            background-position: 0% 50%;
                          }
                        }
                        </style>

                        <div style="display: inline-block;">
                          <div style="position: relative;">
                            <div style="position: absolute; top: -10px; left: -10px; right: -10px; bottom: -10px; background: linear-gradient(45deg, #2193b0, #6dd5ed, #ff9a8b, #ff6a88, #ff99ac, #f6d365, #fda085, black); border-radius: 10px; z-index: -1; animation: gradientEffect 5s ease-in-out infinite;"></div>
                            <div style="position: relative; padding: 10px; border: 5px solid transparent; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); animation: borderAnimation 5s linear infinite;">
                              <span style="background: linear-gradient(45deg, #2193b0, #6dd5ed, #ff9a8b, #ff6a88, #ff99ac, #f6d365, #fda085, black); background-size: 200% 200%; -webkit-text-fill-color: transparent; -webkit-background-clip: text;animation:gradientEffect 5s ease-in-out infinite;">
                                👋 Welcome, {{ auth()->user()->name }}, In Dashboard!!👋
                              </span><br/>
                              <span style="display: inline-block; padding: 10px 12px; border-radius: 4px; font-weight: bold; color: white; background: linear-gradient(45deg, #2193b0, #6dd5ed, #ff9a8b, #ff6a88, #ff99ac, #f6d365, #fda085, black); background-size: 200% 200%; -webkit-text-fill-color: transparent; -webkit-background-clip: text;animation:gradientEffect 5s ease-in-out infinite;">
                                <i class="{{ auth()->user()->roles === 'User' ? 'fas fa-user' : 'fas fa-crown' }}"></i>
                                {{ auth()->user()->roles }}
                              </span>
                            </div>
                          </div>
                        </div>

                    <br/>

                {{-- </marquee> --}}
            </h3>
        </div>
    </td>
</tr>

    {{-- <style>
        @keyframes gradientEffect {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
    </style> --}}


    <div class="container">

        <style>
            @keyframes borderAnimation {
              0% {
                border-color: #2193b0;
              }
              25% {
                border-color: #6dd5ed;
              }
              50% {
                border-color: #ff9a8b;
              }
              75% {
                border-color: #ff6a88;
              }
              100% {
                border-color: #ff99ac;
              }
            }

            @keyframes gradientEffect {
              0% {
                background-position: 0% 50%;
              }
              50% {
                background-position: 100% 50%;
              }
              100% {
                background-position: 0% 50%;
              }
            }
            </style>

            <div class="row mb-4">
              <div class="col-md-6">
                <div class="card" style="animation: borderAnimation 5s linear infinite;">
                  <div class="card-body" style="border:2px solid transparent; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); animation: gradientEffect 5s ease-in-out infinite;">
                    <h5>Category Data</h5>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card" style="animation: borderAnimation 5s linear infinite;">
                  <div class="card-body" style="border: 2px solid transparent; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); animation: gradientEffect 5s ease-in-out infinite;">
                    <h5>Product Data</h5>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card" style="animation: borderAnimation 5s linear infinite;">
                  <div class="card-body" style="border: 2px solid transparent; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); animation: gradientEffect 5s ease-in-out infinite;">
                    <h5>User Data</h5>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card" style="animation: borderAnimation 5s linear infinite;">
                  <div class="card-body" style="border: 2px solid transparent; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); animation: gradientEffect 5s ease-in-out infinite;">
                    <h5>Manage Roles Data</h5>
                  </div>
                </div>
              </div>
            </div>
    </div>
@endsection
