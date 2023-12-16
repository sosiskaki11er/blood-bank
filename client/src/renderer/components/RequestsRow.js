import React from 'react'
import EditIcon from '../assets/icons/edit-02.svg'
import TrashIcon from '../assets/icons/trash-03.svg'

function RequestsRow({setSubpage}) {
  return (
    <div className='table-row'>
            <div className='w-[120px]'>
              <h4>U021891921</h4>
            </div>
            <div className='w-[200px]'>
              <h4>Garrick Fennimore</h4>
            </div>
            <div className='w-[120px]'>
              <h4>28.10.2023</h4>
            </div>
            <div className='w-[80px]'>
              <h4>16:35</h4>
            </div>
            <div className='w-[120px]'>
              <h4>
                <div className='container gap-[8px]'>
                    <div className='indicator approve'/>
                    <h3 className='text-base'>Approved</h3>
                </div>
              </h4>
            </div>
            <div className='container gap-[24px] cursor-pointer'>
                <img src={EditIcon} onClick={() => setSubpage('edit-prescription')}/>
                <img src={TrashIcon}/>
            </div>
</div>
  )
}

export default RequestsRow