import React, { useEffect, useState } from 'react'
import PersonalInfo from './PersonalInfo'
import MedicalInfo from './MedicalInfo'
import BackIcon from '../assets/icons/arrow-narrow-left.svg'
import DonationImg from '../assets/img/blood.png'
import TransfusionImg from '../assets/img/transfusion.png'
import { Socket } from '..'

function EditPrescription({setSubpage,subpage,role}) {
  const user = JSON.parse(localStorage.getItem("user"))
  const appointment = JSON.parse(localStorage.getItem("edit-appointment"))
  const [transfusion,setTransfusion] = useState()
  const [amount, setAmount] = useState(0)
  const [status, setStatus] = useState()
  console.log(appointment)
  const [action, setAction] = useState('donation')

  useEffect(() => {
    setTimeout(() => {
        if(role === "staff"){
            Socket.request("GET",role,"transfusionShow/",`${appointment.guid}:${user.token}`)
            .then(data => {setTransfusion(data.data);console.log(data.data)})
        }
        else{
            Socket.request("GET",role,"infusion/show/",`${appointment.guid}:${user.data.token}`)
            .then(data => {setTransfusion(data.data);console.log(data.data)})
        }
    },100)
  },[])

  const HandleStatus = (status) => {
    setStatus(status)
    if(amount !== 0){
        if(role === 'staff') {
            Socket.request("PUT",role,"bloodTransfusion/",`${appointment?.guid}?status=${status}&amount=${amount/1000}:${user.token}`)
            .then(data => console.log(data.data)) 
        }
        else{
            Socket.request("PUT",role,"infusion/update/",`${appointment?.guid}?status=${status}&amount=${amount/1000}:${user.data.token}`)
            .then(data => console.log(data.data))
            .catch(error => alert("Amount of infusion more than blood bank amount"))
        }
    }
  }

  return (
    <div className='subpage'>
      <button className='tertiary mr-auto flex gap-[8px]' onClick={() => setSubpage('schedule')}>
        <img src={BackIcon} className='my-auto'/>
        <h3>Go back</h3>
      </button>
     
        <div className='component'>
            <h3>Action to be performed</h3>
            <div className='container gap-[20px]'>
                <div className={role === "doctor"?'action active':'action'} onClick={() => setAction('donation')}>
                    <img src={DonationImg}/>
                    <h3 className='text-lg my-auto'>Blood Infusion</h3>
                </div>
                <div className={role=== "staff"?'action active':'action'} onClick={() => setAction('transfusion')}>
                    <img src={TransfusionImg}/>
                    <h3 className='text-lg my-auto'>Blood transfusion</h3>
                </div>
            </div>
        </div>
      
      <div className='component'>
        <h3>Personal information</h3>
        <div className='container flex-col gap-[16px] max-w-[676px]'>
                <div className='flex gap-[12px]'>
                    <div className='container flex-col flex-grow-[1]'>
                        <h4 className='input-header'>First Name*</h4>
                        <input type='text' disabled value={transfusion?.user.name}/>
                    </div>
                    <div className='container flex-col flex-grow-[1]'>
                        <h4 className='input-header'>Second Name*</h4>
                        <input type='text' disabled value={transfusion?.user.surname}/>
                    </div>
                </div>
                <div className='flex gap-[12px]'>
                    <div className='container flex-col flex-grow-[1]'>
                        <h4 className='input-header'>Date of birth*</h4>
                        <input type='text' disabled value={transfusion?.date}/>
                    </div>
                    <div className='container flex-col flex-grow-[1] max-w-[332px]'>
                        <h4 className='input-header'>Phone number</h4>
                        <input type='text' disabled value={transfusion?.user.phone}/>
                    </div>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Email</h4>
                    <input type='text' disabled value={transfusion?.user.email}/>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Address</h4>
                    <input type='text' disabled value={transfusion?.user.address}/>
                </div>
            </div>
      </div>
      <div className='component max-w-[684px]'>
          <h3>Medical information</h3>
          <div className='container flex-col gap-[24px]'>
                <div className='flex gap-[12px] justify-between'>
                    <div className='container flex-col flex-grow-[1] max-w-[332px]'>
                        <h4 className='input-header'>Blood type</h4>
                        <select disabled value={transfusion?.user.blood_type}>
                            <option value={"A"}>A</option>
                            <option value={"B"}>B</option>
                            <option value={"O"}>O</option>
                            <option value={"AB"}>AB</option>
                        </select>
                    </div>
                    <div className='container flex-col flex-grow-[1] max-w-[332px]'>
                        <h4 className='input-header'>Rhesus</h4>
                        <select disabled value={transfusion?.user.blood_rh}>
                            <option value={"%2B"}>+</option>
                            <option value={"-"}>-</option>
                        </select>
                    </div>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Diseases</h4>
                    <input type='text' disabled value={transfusion?.user.blood_disease}/>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Amount of Blood (ml)</h4>
                    <input type='number' max="450" value={amount} onChange={(e) => setAmount(e.target.value)}/>
                </div>
                {(role === 'staff' || role==='doctor') && 
                    <div className='container flex-col gap-[16px]'>
                        <button onClick={()=> HandleStatus(1)}>Accept</button>
                        <button onClick={() => HandleStatus(2)} className='secondary'>Reject</button>
                    </div>
                }
                
          </div>
        </div>
    </div>
  )
}

export default EditPrescription